<?php

namespace App\Livewire\Admin\TaskPost\Modal;

use App\Models\Application;
use App\Models\TaskPosting;
use LivewireUI\Modal\ModalComponent;

class DeleteConfirmationModal extends ModalComponent
{
    public $taskId;

    public function mount($taskId)
    {
        $this->taskId = $taskId;
    }

    public function deleteTask()
    {
        $taskPost = TaskPosting::find($this->taskId);

        if ($taskPost) {
            Application::where('task_id', $this->taskId)->delete();
            $taskPost->delete();
            session()->flash('message', 'Task post deleted successfully.');
            $this->dispatch('taskDeleted');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.task-post.modal.delete-confirmation-modal');
    }
}
