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
    public $location = '';

    public function render()
    {
        // Start with base query to retrieve all task postings
        $query = TaskPosting::query();
    
        // Apply search filter if search term is not empty
        if (!empty($this->search)) {
            $query->where('title', 'like', "%{$this->search}%");
        }
    
        // Apply location filter if location is not empty
        if (!empty($this->location)) {
            $query->where('location', $this->location);
        }
    
        // Fetch task postings based on the applied filters
        $taskPostings = $query->orderBy('created_at', 'desc')->paginate(5);
        
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

    #[On('location')]
    public function updateLocation($location)
    {
        $this->location = $location;
    }    
}
