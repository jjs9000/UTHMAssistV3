<?php

namespace App\Livewire\User\Report;

use App\Models\Report;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class ReportUserModal extends ModalComponent
{
    public $userId;
    public $reason;
    public $additionalReason;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function submitReport()
    {

        $this->validate([
            'reason' => 'required|in:spam,inappropriate_content,harassment',
            'additionalReason' => 'nullable|string|max:255',
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'reason' => $this->reason,
            'additional_reason' => $this->additionalReason,
        ]);

        $this->reset(['reason', 'additionalReason']);
        $this->closeModal();
        session()->flash('message', 'Report submitted successfully!');
    }

    public function render()
    {
        return view('livewire.user.report.report-user-modal');
    }
}
