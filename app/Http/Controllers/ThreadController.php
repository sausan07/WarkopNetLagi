<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('threads.create', compact('categories'));
    }

    public function store(Request $request)
    {
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

    public function show(Thread $thread)
    {
        try {
            $thread->load([
                'user', 
                'category', 
                'posts' => function($query) {
                    $query->with(['user', 'likes']);
                }
            ]);
            
            // Debug: check data
            logger()->info('Thread loaded', [
                'thread_id' => $thread->id,
                'posts_count' => $thread->posts->count(),
                'user' => $thread->user->username ?? 'N/A',
            ]);
            
            return view('threads.show', compact('thread'));
        } catch (\Exception $e) {
            logger()->error('Error in ThreadController@show', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }
}
