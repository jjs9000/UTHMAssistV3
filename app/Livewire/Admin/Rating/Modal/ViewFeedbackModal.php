<?php

namespace App\Livewire\Admin\Rating\Modal;

use App\Models\Feedback;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ViewFeedbackModal extends ModalComponent
{
    public Feedback $feedback;

    public function mount($feedbackId)
    {
        $this->feedback = Feedback::findOrFail($feedbackId);
    }

    public function closeFeedbackModal()
    {
        $this->dispatch('viewFeedbackModalClosed');
        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.admin.rating.modal.view-feedback-modal',[
            'feedback' => $this->feedback,   
        ]);
    }
}