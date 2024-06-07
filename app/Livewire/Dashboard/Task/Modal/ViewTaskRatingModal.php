<?php

namespace App\Livewire\Dashboard\Task\Modal;

use App\Models\Feedback;
use LivewireUI\Modal\ModalComponent;

class ViewTaskRatingModal extends ModalComponent
{
    public $taskId;
    public $feedbacks;

    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $this->feedbacks = Feedback::where('task_id', $this->taskId)->get();
    }

    public function render()
    {
        
        return view('livewire.dashboard.task.modal.view-task-rating-modal',[
            'feedbacks' => $this->feedbacks,
        ]);
    }
}
