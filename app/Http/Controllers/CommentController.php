<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|min:1|max:500',
        ]);

        $comment = $post->comments()->create([
            'body' => $data['body'],
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'comment added succefully');
    }
}
