<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Post::where('category', 'Hướng dẫn')
            ->where('is_published', true)
            ->with(['comments.user'])
            ->latest()
            ->get();
        return view('user.guide', compact('guides'));
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi!');
    }
}
