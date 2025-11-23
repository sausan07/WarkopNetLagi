<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\Attributes\On; // WAJIB untuk Livewire 3

class ReportButton extends Component
{
    public $threadId = null;
    public $postId = null;
    public $showModal = false;
    public $reason = '';

    // notif variables
    public $showNotif = false;
    public $notifMessage = '';
    public $notifType = 'success';

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

        // Cek sudah melapor
        $reportin = Report::where('user_id', auth()->id())
            ->where(function($q) {
                if ($this->threadId) {
                    $q->where('thread_id', $this->threadId);
                }
                if ($this->postId) {
                    $q->where('post_id', $this->postId);
                }
            })
            ->first();

        if ($reportin) {
            // ERROR notif
            $this->showNotif('Anda sudah melaporkan konten ini.', 'error');
            $this->closeModal();
            return;
        }

        // Buat laporan
        Report::create([
            'user_id' => auth()->id(),
            'thread_id' => $this->threadId,
            'post_id' => $this->postId,
            'reason' => $this->reason,
            'status' => 'pending',
        ]);

        // SUCCESS notif
        $this->showNotif('Laporan berhasil dikirim. Terima kasih!', 'success');

        $this->closeModal();
        $this->dispatch('report-submitted');
    }

    // --- notif Method ---
    public function showNotif($message, $type = 'success')
    {
        $this->notifMessage = $message;
        $this->notifType = $type;
        $this->showNotif = true;

        $this->dispatch('hide-notif');
    }

    #[On('hide-notif')]
    public function hideNotif()
    {
        sleep(3);
        $this->showNotif = false;
    }

    public function render()
    {
        return view('livewire.report-button');
    }
}
