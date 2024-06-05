<?php

namespace App\Livewire\Admin\User\Modal\Report;

use App\Models\Report;
use LivewireUI\Modal\ModalComponent;

class ViewUserReportModal extends ModalComponent
{
    public $userId;
    public $reports;

    public function mount($userId)
    {
        $this->userId = $userId;
        // Fetch reports where reported_user_id matches the provided $userId
        $this->reports = Report::where('reported_user_id', $this->userId)->get();
    }

    public function render()
    {
        return view('livewire.admin.user.modal.report.view-user-report-modal', [
            'reports' => $this->reports,
        ]);
    }
}
