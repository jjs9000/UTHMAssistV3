<?php

namespace App\Livewire\Admin\Application\Modal;

use App\Models\Application;
use LivewireUI\Modal\ModalComponent;

class ViewModal extends ModalComponent
{
    public $applicationId;
    public $application;

    public function mount($applicationId)
    {
        $this->application = Application::with(['user', 'task'])->find($applicationId);
    }

    public function render()
    {
        return view('livewire.admin.application.modal.view-modal',[
            'application' => $this->application,
        ]);
    }
}
