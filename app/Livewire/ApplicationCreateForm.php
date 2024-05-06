<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;
use App\Models\Application;

class ApplicationCreateForm extends Component
{
    public $taskPosting;
    public $taskId;
    public $message;

    protected $rules = [
        'message' => 'nullable|string',
    ];

    public function mount($taskId)
    {
        $this->taskPosting = TaskPosting::find($taskId);
        $this->taskId = $taskId;
    }

    public function render()
    {
        return view('livewire.application-create-form');
    }

    public function submit()
    {
        $this->validate();

        // Create an application record
        Application::create([
            'task_id' => $this->taskId,
            'user_id' => auth()->id(),
            'message' => $this->message,
        ]);

        // Redirect the user back to the Application page with a success message
        return redirect()->route('application')->with('message', 'Successfully applied for the task.');
    }
}
