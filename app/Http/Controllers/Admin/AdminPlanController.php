<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class AdminPlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'features' => 'required|array',
        ]);

        Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Thêm gói mới thành công!');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'features' => 'required|array',
        ]);

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Cập nhật gói thành công!');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Xóa gói thành công!');
    }
}
