<?php

namespace App\Livewire\User\Application\Modal;

use LivewireUI\Modal\ModalComponent;
use App\Models\Application;

class ApplicationConfirmationModal extends ModalComponent
{
    public $applicationId;
    public $actionType;

    public function mount($applicationId, $actionType)
    {
        $this->applicationId = $applicationId;
        $this->actionType = $actionType;
    }

    public function acceptApplication()
    {
        $application = Application::find($this->applicationId);
        if ($application) {
            $application->status = 'accepted';
            $application->save();

            $this->dispatch('applicationAccepted'); // Refresh the applications list
            $this->closeModal();
        }
    }

    public function rejectApplication()
    {
        $application = Application::find($this->applicationId);
        if ($application) {
            $application->status = 'rejected';
            $application->save();

            $this->dispatch('applicationRejected'); // Refresh the applications list
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.user.application.modal.application-confirmation-modal');
    }
}
