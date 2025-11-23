<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{
    public $postId;
    public $likesCount = 0;
    public $isLiked = false;

    public function mount($postId) {
        $this->postId = $postId;
        $this->loadLikeData();
    }

    public function loadLikeData() {
        $post = Post::find($this->postId);
        if ($post) {
            $this->likesCount = $post->likes()->count();
            
            if (auth()->check()) {
                $this->isLiked = $post->likes()
                ->where('user_id', auth()->id())
                ->exists();
            }
        }
    }


    public function toggleLike() {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isLiked) {
            //unlike
            Like::where('user_id', auth()->id())
            ->where('post_id', $this->postId)
            ->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } 
        
        else {
            //like
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $this->postId,
            ]);

            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function render() {
        return view('livewire.like-button');
    }
}
