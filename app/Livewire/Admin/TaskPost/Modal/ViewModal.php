<?php

namespace App\Livewire\Admin\TaskPost\Modal;

use App\Models\TaskPosting;
use LivewireUI\Modal\ModalComponent;

class ViewModal extends ModalComponent
{
    public TaskPosting $taskPost;

    public function mount($taskPostId)
    {
        $this->taskPost = TaskPosting::findOrFail($taskPostId);
    }

    public function render()
    {
        return view('livewire.admin.task-post.modal.view-modal',[
            'taskPost' => $this->taskPost,
        ]);
    }
}
