<?php

namespace App\Livewire\Dashboard\Task\Modal;

use App\Models\Feedback;
use LivewireUI\Modal\ModalComponent;

class TaskRatingModal extends ModalComponent
{
    public $taskId;
    public $rating;
    public $comment;

    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $this->rating = 0;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function submitRating()
    {
        // Validate input
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // Save the rating
        Feedback::create([
            'task_id' => $this->taskId,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->dispatch('taskRated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.dashboard.task.modal.task-rating-modal');
    }
}
