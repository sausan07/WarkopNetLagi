<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ProfileTabs extends Component
{
    public $user;
    public $activeTab = 'threads';

        // tambahkan listener untuk refresh bookmark
    protected $listeners = ['bookmarkToggled' => '$refresh'];

    public function mount($user){
        $this->user = $user;
    }

    public function setTab($tab){
        $this->activeTab = $tab;
    }

    public function render(){
        return view('livewire.profile-tabs');
    }
}

