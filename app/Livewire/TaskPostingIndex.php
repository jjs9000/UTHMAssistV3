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
    public $sortBy = 'latest';

    public function render()
    {
        // Start with base query to retrieve all task postings
        $query = TaskPosting::where('user_id', '!=', auth()->id()) // Exclude tasks by the original poster
                            ->where('status', '!=', 'not_available') // Exclude tasks with status 'not_available'
                            ->whereDate('deadline', '>=', now()); // Exclude expired tasks
        
        // Apply search filter if search term is not empty
        if (!empty($this->search)) {
            $query->where('title', 'like', "%{$this->search}%");
        }
        
        // Apply location filter if location is not empty
        if (!empty($this->location)) {
            $query->where('location', $this->location);
        }
    
        // Apply sorting based on sortBy property
        switch ($this->sortBy) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'salary_high':
                $query->orderBy('salary', 'desc');
                break;
            case 'salary_low':
                $query->orderBy('salary', 'asc');
                break;
        }
        
        // Fetch task postings based on the applied filters and paginate the results
        $taskPostings = $query->paginate(5);
        
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
