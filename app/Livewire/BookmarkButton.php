<?php

namespace App\Livewire;

use App\Models\Bookmark;
use App\Models\Post;
use Livewire\Component;

class BookmarkButton extends Component
{
    public $threadId = null;
    public $postId = null;
    public $isBookmarked = false;

    public function mount($threadId = null, $postId = null)
    {
        $this->threadId = $threadId;
        $this->postId = $postId;
        $this->checkBookmarkStatus();
    }

    public function checkBookmarkStatus()
    {
        if (auth()->check()) {
            $query = Bookmark::where('user_id', auth()->id());
            
            if ($this->threadId) {
                $query->where('thread_id', $this->threadId);
            }
            
            if ($this->postId) {
                $query->where('post_id', $this->postId);
            }
            
            $this->isBookmarked = $query->exists();
        }
    }

    public function toggleBookmark()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isBookmarked) {
            // Remove bookmark
            $query = Bookmark::where('user_id', auth()->id());
            
            if ($this->threadId) {
                $query->where('thread_id', $this->threadId);
            }
            
            if ($this->postId) {
                $query->where('post_id', $this->postId);
            }
            
            $query->delete();
            $this->isBookmarked = false;
        } else {
            // Add bookmark
            Bookmark::create([
                'user_id' => auth()->id(),
                'thread_id' => $this->threadId,
                'post_id' => $this->postId,
            ]);
            $this->isBookmarked = true;
        }
    }

    public function render()
    {
        return view('livewire.bookmark-button');
    }
}
