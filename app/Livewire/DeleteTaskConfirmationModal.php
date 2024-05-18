<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\TaskPosting;

class DeleteTaskConfirmationModal extends ModalComponent
{
    public $taskId;

    public function mount($taskId)
    {
        $this->taskId = $taskId;
    }

    public function deleteTask()
    {
        // Find the task by ID and delete it
        $task = TaskPosting::find($this->taskId);
        if ($task) {
            $task->delete();
        }

        $this->dispatch('taskDeleted');

        // Close the modal
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-task-confirmation-modal');
    }
}
