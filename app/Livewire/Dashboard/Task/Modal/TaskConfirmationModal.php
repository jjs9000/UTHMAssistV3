<?php

namespace App\Livewire\Dashboard\Task\Modal;

use App\Models\Application;
use LivewireUI\Modal\ModalComponent;

class TaskConfirmationModal extends ModalComponent
{
    public $applicationId;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
    }

    public function completeTask()
    {
        // Retrieve the application
        $application = Application::findOrFail($this->applicationId);
    
        // Update the status of the associated task to "completed"
        $task = $application->task;
        $task->status = 'completed';
        $task->save();
    
        // Refresh the applications list
        $this->dispatch('taskCompleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.dashboard.task.modal.task-confirmation-modal');
    }
}
