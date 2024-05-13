<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Application;
use Livewire\Attributes\On;

class ApplicationReceive extends Component
{
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

    #[On('acceptApplication')]
    public function acceptApplication($applicationId)
    {
        // Logic to accept the application
        $application = Application::findOrFail($applicationId);
        $application->update(['status' => 'accepted']);

        // You can add any additional logic here, such as sending notifications

        // Refresh the component to reflect changes
        $this->render();
    }

    #[On('rejectApplication')]
    public function rejectApplication($applicationId)
    {
        // Logic to reject the application
        $application = Application::findOrFail($applicationId);
        $application->update(['status' => 'rejected']);

        // You can add any additional logic here, such as sending notifications

        // Refresh the component to reflect changes
        $this->render();
    }
}
