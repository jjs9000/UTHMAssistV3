<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;
use Illuminate\Support\Facades\Redirect;

use Livewire\Attributes\On;

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

    #[On('redirectToTaskPostingPage')]
    public function redirectToTaskPostingPage()
    {
        // Redirect to the user's task posting page
        return redirect()->route('task-posting-page');
    }

    #[On('redirectToTaskPostingShow')]
    public function redirectToTaskPostingShow()
    {
        $taskId = $this->selectedTask->id;
        $url = route('task-posting.show', ['id' => $taskId]);
        
        // Open the URL in a new tab using JavaScript
        $script = "<script>window.open('{$url}', '_blank')</script>";
        return $script;
    }
}
