<?php

namespace App\Livewire\User\Report;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ReportUserModal extends ModalComponent
{
    public $userId; // ID of the user being reported
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
            'reporter_id' => Auth::id(), // ID of the user making the report
            'reported_user_id' => $this->userId, // ID of the user being reported
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
