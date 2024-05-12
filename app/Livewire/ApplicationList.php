<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Application;

class ApplicationList extends Component
{
    public function render()
    {
        // Fetch user's applied tasks and paginate by 5
        $applications = Application::where('user_id', auth()->id())->paginate(5);

        return view('livewire.application-list', [
            'applications' => $applications,
        ]);
    }
}
