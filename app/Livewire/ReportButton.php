<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;

class ReportButton extends Component
{
    public $threadId = null;
    public $postId = null;
    public $showModal = false;
    public $reason = '';
    
    protected $rules = [
        'reason' => 'required|string|min:10|max:500',
    ];

    public function openModal()
    {
        $this->showModal = true;
        $this->reason = '';
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset('reason');
        $this->resetValidation();
    }

    public function submitReport()
    {
        $this->validate();

        // Check if already reported
        $existing = Report::where('user_id', auth()->id())
            ->where(function($q) {
                if ($this->threadId) {
                    $q->where('thread_id', $this->threadId);
                }
                if ($this->postId) {
                    $q->where('post_id', $this->postId);
                }
            })
            ->first();

        if ($existing) {
            session()->flash('error', 'Anda sudah melaporkan konten ini sebelumnya.');
            $this->closeModal();
            return;
        }

        Report::create([
            'user_id' => auth()->id(),
            'thread_id' => $this->threadId,
            'post_id' => $this->postId,
            'reason' => $this->reason,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Laporan berhasil dikirim. Terima kasih!');
        $this->closeModal();
        $this->dispatch('report-submitted');
    }

    public function render()
    {
        return view('livewire.report-button');
    }
}
