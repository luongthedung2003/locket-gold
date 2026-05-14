<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('user.pricing', compact('plans'));
    }
}