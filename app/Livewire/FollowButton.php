<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{
    public $userId;
    public $isFollowing = false;
    public $followersCount = 0;

    public function mount($userId) {
        $this->userId = $userId;

        $this->checkFollowStatus();

        // hitung follower awal
        $this->followersCount = User::find($userId)->followers()->count();
    }

    public function checkFollowStatus() {
        if (Auth::check()) {
            $this->isFollowing = Auth::user()
                ->following()
                ->where('following_id', $this->userId)
                ->exists();
        }
    }

    public function toggleFollow(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isFollowing) {
            Follow::where('follower_id', Auth::id())
                ->where('following_id', $this->userId)
                ->delete();

            $this->isFollowing = false;
            $this->followersCount--; // decrement
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'following_id' => $this->userId,
            ]);

            $this->isFollowing = true;
            $this->followersCount++; // increment
        }

        //biar auto nambah kata gpt
        $this->dispatch('followUpdated');
    }

    public function render() {
        return view('livewire.follow-button');
    }
}
