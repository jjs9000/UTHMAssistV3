<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;
use Livewire\Attributes\On;

class TaskPostingShow extends Component
{
    public $task;

    public function mount($id)
    {
        $this->task = TaskPosting::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.task-posting-show');
    }

    #[On('apply')]
    public function apply()
    {
        // Redirect the user to the ApplicationCreateForm component
        return redirect()->route('application-create-form', [
            'taskId' => $this->task->id
        ]);
    }
}
