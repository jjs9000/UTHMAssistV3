<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Application;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ApplicationList extends Component
{
    use WithPagination;

    public $sortBy = 'asc';
    public $taskStatus = '';
    public $applicationStatus = '';

    public function render()
    {
        $query = Application::where('user_id', Auth::id());

        if ($this->taskStatus) {
            $query->whereHas('task', function ($q) {
                $q->where('status', $this->taskStatus);
            });
        }

        if ($this->applicationStatus) {
            $query->where('status', $this->applicationStatus);
        }

        if ($this->sortBy === 'desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        $applications = $query->paginate(5);

        return view('livewire.application-list', [
            'applications' => $applications,
        ]);
    }
}
