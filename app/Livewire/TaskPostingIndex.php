<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;

class TaskPostingIndex extends Component
{
    public $taskPostings;
    public $selectedTask;

    public function mount()
    {
        $this->taskPostings = TaskPosting::all();
    }

    public function render()
    {
        $noTasksAvailable = $this->taskPostings->isEmpty();

        return view('livewire.task-posting-index', [
            'noTasksAvailable' => $noTasksAvailable,
        ]);
    }

    public function showTask($taskId)
    {
        $this->selectedTask = TaskPosting::find($taskId);
    }
}
