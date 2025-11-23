<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    public function create() {
        $categories = Category::all();
        return view('threads.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thread = Thread::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
        ]);

        return redirect()->route('threads.show', $thread->slug)
        ->with('success', 'Diskusi berhasil dibuat!');
    }

    public function show(Thread $thread) { 
            $thread->load([
                'user', 
                'category', 
                'posts' => function($query) {
                    $query->with(['user', 'likes']);
                }
            ]);
            
            return view('threads.show', compact('thread'));
        
        
        
    }
}
