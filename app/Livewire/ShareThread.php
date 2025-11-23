<?php

namespace App\Livewire;

use Livewire\Component;

class ShareThread extends Component
{
    public $threadUrl;

    public function mount($threadUrl){
        $this->threadUrl = $threadUrl;
    }

    public function copy(){
        // Cuma memanggil event JS
        $this->dispatch('copyToClipboard', text: $this->threadUrl);
    }

    public function render(){
        return view('livewire.share-thread');
    }
}
