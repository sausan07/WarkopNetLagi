<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ProfileStats extends Component
{
    public $userId;
    public $user;

    protected $listeners = ['followUpdated' => 'refreshStats'];

    

    public function refreshStats() {

        $user = User::find($this->userId);
        $this->followers = $user->followers->count();
        $this->following = $user->following->count();
        $this->threads = $user->threads->count();
        $this->posts = $user->posts->count();
    }


        public $followers;
        public $following;
        public $threads;
        public $posts;

    public function mount($userId) {
        $this->userId = $userId;

        $user = User::find($userId);

        $this->followers = $user->followers->count();
        $this->following = $user->following->count();
        $this->threads = $user->threads->count();
        $this->posts = $user->posts->count();
    }


    public function render(){
        // refresh user data setiap render
        $this->user = User::find($this->userId);

        return view('livewire.profile-stats');
    }
}
