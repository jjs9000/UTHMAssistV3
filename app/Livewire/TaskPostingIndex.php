<?php

namespace App\Livewire;

use App\Models\Bookmark;
use App\Models\Feedback;
use Livewire\Component;
use App\Models\TaskPosting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class TaskPostingIndex extends Component
{

    use WithPagination;

    public $savedTask;
    public $selectedTask;
    public $search = '';
    public $location = '';
    public $sortBy = 'latest';
    public $savedTaskIds = [];

    public function render()
    {
        // Start with base query to retrieve all task postings
        $query = TaskPosting::where('user_id', '!=', auth()->id()) // Exclude tasks by the original poster
                            ->where('status', '!=', 'not_available') // Exclude tasks with status 'not_available'
                            ->where('status', '!=', 'ongoing') // Exclude tasks with status 'not_available'
                            ->where('status', '!=', 'completed') // Exclude tasks with status 'not_available'
                            ->whereDate('deadline', '>', now()); // Exclude expired tasks
        
        // Apply search filter if search term is not empty
        if (!empty($this->search)) {
            $searchTerm = "%{$this->search}%";
            $query->where('status', '!=', 'not_available') // Exclude tasks with status 'not_available'
                ->where('status', '!=', 'ongoing') // Exclude tasks with status 'ongoing'
                ->where('status', '!=', 'completed') // Exclude tasks with status 'completed'
                ->where(function ($query) use ($searchTerm) {
                    $query->where('title', 'like', $searchTerm)
                            ->orWhereHas('tags', function ($query) use ($searchTerm) {
                                $query->where('name', 'like', $searchTerm);
                            })
                            ->orWhereHas('user', function ($query) use ($searchTerm) {
                                $query->where('username', 'like', $searchTerm);
                            });
                });
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

        $this->savedTaskIds = Bookmark::where('user_id', Auth::id())
                                           ->pluck('task_posting_id')
                                           ->toArray();
        
    
        return view('livewire.task-posting-index', [
            'taskPostings' => $taskPostings,
            'noTasksAvailable' => $noTasksAvailable,
            'savedTask' => $this->savedTask,
            'savedTaskIds' => $this->savedTaskIds,
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

    public function toggleBookmark($taskId)
    {
        $this->savedTask = TaskPosting::find($taskId);

        if (in_array($taskId, $this->savedTaskIds)) {
            Bookmark::where('user_id', Auth::id())
                    ->where('task_posting_id', $taskId)
                    ->delete();
            $this->savedTaskIds = array_diff($this->savedTaskIds, [$taskId]);
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'task_posting_id' => $taskId,
            ]);
            $this->savedTaskIds[] = $taskId;
        }
    }
}
