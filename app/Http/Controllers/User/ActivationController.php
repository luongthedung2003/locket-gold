<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use App\Services\LocketUpgradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    protected $locketService;

    public function __construct(LocketUpgradeService $locketService)
    {
        $this->locketService = $locketService;
    }

    public function index()
    {
        // For demo/dev purposes, if no activation exists, we show a message or create one
        // In real app, this is created after payment.
        $activation = Activation::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'processing', 'completed'])
            ->with('plan')
            ->latest()
            ->first();

        return view('user.activation', compact('activation'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'locket_username' => 'required|string|min:3',
            'activation_id' => 'required|exists:activations,id'
        ]);

        $activation = Activation::findOrFail($request->activation_id);

        if ($activation->status === 'completed') {
            return response()->json(['success' => false, 'message' => 'Gói này đã được kích hoạt thành công trước đó.']);
        }

        // 1. Resolve UID
        $uid = $this->locketService->resolveUid($request->locket_username);
        if (!$uid) {
            $activation->update(['status' => 'failed', 'notes' => 'Không tìm thấy User Locket.']);
            return response()->json(['success' => false, 'step' => 'resolve', 'message' => 'Không tìm thấy User Locket. Vui lòng kiểm tra lại Username.']);
        }

        $activation->update([
            'locket_username' => $request->locket_username,
            'locket_uid' => $uid,
            'status' => 'injecting'
        ]);

        // 2. Inject Gold
        $result = $this->locketService->injectGold($uid);
        if (!$result['success']) {
            $activation->update(['status' => 'failed', 'notes' => $result['message']]);
            return response()->json(['success' => false, 'step' => 'inject', 'message' => $result['message']]);
        }

        // 3. Create NextDNS
        $dns = $this->locketService->createNextDnsProfile($request->locket_username);
        
        $activation->update([
            'status' => 'completed',
            'dns_link' => $dns['link'] ?? null,
            'notes' => 'Kích hoạt thành công vào lúc ' . now()->format('H:i d/m/Y')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kích hoạt Locket Gold thành công!',
            'dns_link' => $dns['link'] ?? null,
            'expires' => $result['expires'] ?? 'N/A'
        ]);
    }
}