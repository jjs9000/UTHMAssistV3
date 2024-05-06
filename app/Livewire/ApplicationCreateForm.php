<?php

namespace App\Livewire;

use App\Models\TaskPosting;
use Livewire\Component;

class ApplicationCreateForm extends Component
{
    public $taskId;
    public $message;

    public function mount(TaskPosting $taskId)
    {
        $this->taskId = $taskId;
    }

    public function submit()
    {
        // Validate the form fields
        $this->validate([
            'message' => 'nullable|string',
        ]);

        // Create or update the application logic here

        session()->flash('success', 'Application submitted successfully.');

        // Redirect or emit event if needed
    }

    public function render()
    {
        return view('livewire.application-create-form');
    }
}
