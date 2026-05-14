<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activation;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_activations' => Activation::count(),
            'total_contacts' => Contact::count(),
            'total_posts' => Post::count(),
            'total_comments' => Comment::count(),
            'recent_activations' => Activation::with('user', 'plan')->latest()->take(5)->get(),
            'recent_contacts' => Contact::latest()->take(5)->get(),
            'recent_comments' => Comment::with('user', 'post')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}