<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Plan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)->latest()->take(3)->get();
        $plans = Plan::all();
        return view('user.home', compact('posts', 'plans'));
    }
}
