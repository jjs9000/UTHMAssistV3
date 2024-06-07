<?php

namespace App\Livewire\Dashboard\Task;

use App\Models\Application;
use App\Models\TaskPosting;
use Livewire\Component;
use Livewire\WithPagination;

class CompletedTask extends Component
{   
    use WithPagination;

    public $sortBy = 'desc';

    protected $listeners = ['taskRated' => '$refresh'];

    public function render()
    {
        $userId = auth()->id();

        // Fetch completed tasks associated with the user as a poster or an applicant
        $query = Application::where(function ($query) use ($userId) {
            $query->whereHas('task', function ($subquery) use ($userId) {
                $subquery->where('status', 'completed')
                    ->where('user_id', $userId); // Task poster
            })->orWhere(function ($subquery) use ($userId) {
                $subquery->where('user_id', $userId) // Applicant
                    ->whereHas('task', function ($taskQuery) {
                        $taskQuery->where('status', 'completed');
                    });
            });
        });

        // Apply sorting based on sortBy property
        if ($this->sortBy === 'desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        // Fetch the applications with pagination
        $applications = $query->paginate(5);

        return view('livewire.dashboard.task.completed-task', [
            'applications' => $applications,
        ]);
    }
}
