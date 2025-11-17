<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public $userId;
    public $isFollowing = false;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->checkFollowStatus();
    }

    public function checkFollowStatus()
    {
        if (auth()->check()) {
            $this->isFollowing = auth()->user()->following()
                ->where('following_id', $this->userId)
                ->exists();
        }
    }

    public function toggleFollow()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isFollowing) {
            // Unfollow
            Follow::where('follower_id', auth()->id())
                ->where('following_id', $this->userId)
                ->delete();
            $this->isFollowing = false;
        } else {
            // Follow
            Follow::create([
                'follower_id' => auth()->id(),
                'following_id' => $this->userId,
            ]);
            $this->isFollowing = true;
        }
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
