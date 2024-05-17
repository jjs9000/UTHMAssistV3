<?php

namespace App\Livewire;

use App\Models\TaskPosting;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ViewTaskModal extends ModalComponent
{
    public TaskPosting $task;

    public function mount($taskId)
    {
        $this->task = TaskPosting::findOrFail($taskId);
    }

    public function closeTaskModal()
    {
        $this->dispatch('viewTaskModalClosed');
        $this->closeModal();  // Call the existing method from LivewireUI\Modal\ModalComponent
    }

    public function render(): View
    {
        return view('livewire.view-task-modal',[
            'task' => $this->task,   
        ]);
    }
}
