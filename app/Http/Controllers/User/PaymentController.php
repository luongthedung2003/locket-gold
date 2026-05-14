<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Order;
use App\Models\Activation;
use App\Services\SePayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $sePay;

    public function __construct(SePayService $sePay)
    {
        $this->sePay = $sePay;
    }

    /**
     * Show Checkout Page
     */
    public function checkout($planId)
    {
        $plan = Plan::findOrFail($planId);
        
        // Check if user already has a pending order for this plan
        $order = Order::where('user_id', Auth::id())
            ->where('plan_id', $planId)
            ->where('status', 'pending')
            ->first();

        if ($order) {
            // Update amount if price changed and update memo to new format
            $user = Auth::user();
            $userName = strtoupper(Str::slug($user->name, ''));
            $newMemo = 'LK' . $user->id . $userName . strtoupper(Str::random(4));
            
            $order->update([
                'amount' => $plan->price,
                'payment_memo' => $newMemo
            ]);
        } else {
            $user = Auth::user();
            $userName = strtoupper(Str::slug($user->name, ''));
            $memo = 'LK' . $user->id . $userName . strtoupper(Str::random(4));
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'plan_id' => $planId,
                'amount' => $plan->price,
                'payment_memo' => $memo,
                'status' => 'pending'
            ]);
        }

        $qrUrl = $this->sePay->generateQrUrl($order->amount, $order->payment_memo);

        return view('user.checkout', compact('plan', 'order', 'qrUrl'));
    }

    /**
     * Handle SePay Webhook
     */
    public function webhook(Request $request)
    {
        $authHeader = $request->header('Authorization');
        Log::info('SePay Webhook Received', [
            'auth' => $authHeader,
            'payload' => $request->all()
        ]);
        
        if (!$this->sePay->validateWebhook($authHeader)) {
            Log::warning('SePay Webhook: Invalid Key');
            return response()->json(['message' => 'Invalid Webhook Key'], 401);
        }

        $payload = $request->all();
        $data = $this->sePay->parseTransaction($payload);
        $fullContent = $payload['content'] ?? '';
        
        Log::info('SePay Parsed Data', $data);

        // Find order by searching our memo inside the full content
        $pendingOrders = Order::where('status', 'pending')->get();
        $matchedOrder = null;

        foreach ($pendingOrders as $order) {
            if (str_contains(strtoupper($fullContent), strtoupper($order->payment_memo))) {
                $matchedOrder = $order;
                break;
            }
        }

        if ($matchedOrder) {
            $order = $matchedOrder;
            Log::info('SePay Order Found via Content Match', ['order_id' => $order->id]);
            
            // Verify amount (allow small difference if needed, but here exact/greater)
            if ($data['amount'] >= $order->amount) {
                $order->update(['status' => 'paid']);

                // Create activation record
                Activation::create([
                    'user_id' => $order->user_id,
                    'plan_id' => $order->plan_id,
                    'status' => 'pending'
                ]);

                Log::info('SePay Payment Success', ['order_id' => $order->id]);
                return response()->json(['message' => 'Payment processed successfully']);
            } else {
                Log::warning('SePay Amount Mismatch', [
                    'expected' => $order->amount,
                    'received' => $data['amount']
                ]);
            }
        } else {
            Log::warning('SePay Order Not Found', ['memo' => $data['memo']]);
        }

        return response()->json(['message' => 'Order not found or already processed'], 200);
    }

    /**
     * Check Order Status (Ajax for frontend)
     */
    public function checkStatus($orderId)
    {
        $order = Order::findOrFail($orderId);
        return response()->json([
            'status' => $order->status
        ]);
    }
}
