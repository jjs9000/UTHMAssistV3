<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;

use Livewire\Attributes\On;
use Livewire\WithPagination;

class TaskPostingIndex extends Component
{

    use WithPagination;

    // public $taskPostings;
    public $selectedTask;
    public $search = '';

    public function render()
    {
        // Apply search filter if search term is not empty
        if (!empty($this->search)) {
            $taskPostings = TaskPosting::where('title', 'like', "%{$this->search}%")->paginate(5);
        } else {
            $taskPostings = TaskPosting::paginate(5);
        }
        
        $noTasksAvailable = $taskPostings->isEmpty();
    
        return view('livewire.task-posting-index', [
            'taskPostings' => $taskPostings,
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

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }
}
