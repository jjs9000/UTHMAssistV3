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

    protected $messages = [
        'message.string' => 'The message must be in type string',
        'message.max' => 'The message is too long. Maximum 100 characters',
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
        $rules = [
            'message' => 'nullable|string|max:100',
        ];

        $this->validate($rules);

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
