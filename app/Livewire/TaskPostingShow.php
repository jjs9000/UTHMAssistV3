<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;

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
}
