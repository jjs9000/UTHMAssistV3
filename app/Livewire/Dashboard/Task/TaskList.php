<?php

namespace App\Livewire\Dashboard\Task;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    public $sortBy = 'desc';

    protected $listeners = ['taskCompleted' => '$refresh'];

    public function render()
    {
        $userId = auth()->id();

        $applications = Application::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'accepted');
        })->orWhereHas('task', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });

        // Check if there are any applications with the task status 'ongoing'
        $noApplications = Application::whereHas('task', function ($query) {
            $query->where('status', 'ongoing');
        })->count() == 0;

        // Apply sorting
        if ($this->sortBy === 'desc') {
            $applications->orderBy('created_at', 'desc');
        } else {
            $applications->orderBy('created_at', 'asc');
        }

        $applications = $applications->paginate(5);

        return view('livewire.dashboard.task.task-list', [
            'applications' => $applications,
            'noApplications' => $noApplications,
        ]);
    }
}