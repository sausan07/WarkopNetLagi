<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
       
        $threadsQuery = Thread::with(['user', 'category', 'posts']);

        // filtr kategori
        if ($request->has('category')) {
            $categorySlug = $request->category;
            $threadsQuery->whereHas('category', function($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        
        $threads = $threadsQuery->latest()->paginate(10);

        
        $categories = Category::withCount('threads')->get();

        
        $suggestedUsers = User::where('id', '!=', auth()->id())
            ->where('user_role', 'member')
            ->withCount('followers')
            ->orderBy('followers_count', 'desc')
            ->limit(5)
            ->get();

       
        $selectedCategory = $request->category;

      
        return view('home', compact('threads','categories','suggestedUsers','selectedCategory'));
    }

    // cari thrd
    public function search(Request $request)
    {
        $searchQuery = $request->input('t');

     
        $threads = Thread::with(['user', 'category', 'posts'])
            ->where(function($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('content', 'like', '%' . $searchQuery . '%');
            })
            ->latest()
            ->paginate(10);

       
        $categories = Category::withCount('threads')->get();

        
        $suggestedUsers = User::where('id', '!=', auth()->id())
            ->where('user_role', 'member')
            ->withCount('followers')
            ->orderBy('followers_count', 'desc')
            ->limit(5)
            ->get();

        $selectedCategory = null; 

    
        return view('home', compact('threads', 'categories', 'suggestedUsers', 'selectedCategory', 'searchQuery'));
    }
}
