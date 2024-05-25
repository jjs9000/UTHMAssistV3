<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Application;

class ApplicationReceive extends Component
{
    public $applicationId;

    protected $listeners = ['applicationAccepted' => '$refresh', 'applicationRejected' => '$refresh'];

    public function render()
    {
        // Fetch applications received by the user for their tasks
        $applications = Application::whereHas('task', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate(5);

        return view('livewire.application-receive', [
            'applications' => $applications,
        ]);
    }
}
