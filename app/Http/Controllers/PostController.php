<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request, Thread $thread){
        $validated = $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $post = Post::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'thread_id' => $thread->id,
            'status' => 'active',
        ]);

        return redirect()->route('threads.show', $thread->slug)
        ->with('success', 'Balasan berhasil ditambahkan!');
    }
}
