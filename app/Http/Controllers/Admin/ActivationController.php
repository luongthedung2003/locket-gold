<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function index()
    {
        $activations = \App\Models\Activation::with(['user', 'plan'])->latest()->paginate(20);
        return view('admin.activations.index', compact('activations'));
    }
}