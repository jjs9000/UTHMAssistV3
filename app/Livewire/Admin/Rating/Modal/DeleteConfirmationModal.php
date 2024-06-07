<?php

namespace App\Livewire\Admin\Rating\Modal;

use App\Models\Feedback;
use LivewireUI\Modal\ModalComponent;

class DeleteConfirmationModal extends ModalComponent
{
    public $feedbackId;

    public function mount($feedbackId)
    {
        $this->feedbackId = $feedbackId;
    }

    public function deleteFeedback()
    {
        $feedback = Feedback::findOrFail($this->feedbackId);
        $feedback->delete();

        $this->dispatch('feedbackDeleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.rating.modal.delete-confirmation-modal');
    }
}
