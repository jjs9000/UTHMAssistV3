<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskPosting;

class TaskPostingShow extends Component
{
    public $taskPosting;

    public function mount($taskPosting)
    {
        $this->taskPosting = $taskPosting;
    }

    public function render()
    {
        return view('livewire.task-posting-show');
    }
}
