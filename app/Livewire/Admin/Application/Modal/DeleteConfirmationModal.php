<?php

namespace App\Livewire\Admin\Application\Modal;

use App\Models\Application;
use LivewireUI\Modal\ModalComponent;

class DeleteConfirmationModal extends ModalComponent
{
    public $applicationId;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
    }

    public function deleteApplication()
    {
        $application = Application::find($this->applicationId);
        
        if ($application) {
        $application->delete();
        session()->flash('message', 'Application deleted successfully.');
        $this->dispatch('applicationDeleted');
        $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.application.modal.delete-confirmation-modal');
    }
}
