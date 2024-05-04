<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\TaskPosting;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class TaskPostingCreate extends Component
{
    public $title;
    public $description;
    public $requirement;
    public $salary;
    public $location;
    public $deadline;
    public $selectedTags = [];

    public function render()
    {
        $tags = Tag::all();
        return view('livewire.task-posting-create', [
            'tags' => $tags,
        ]);
    }

    public function createTask()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'requirement' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'deadline' => 'required|date',
        ]);

        // Clean and cast salary to a decimal
        $cleanedSalary = filter_var(str_replace(['RM', ','], '', $this->salary), FILTER_VALIDATE_FLOAT);

        // Create the task posting
        $taskPosting = TaskPosting::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'requirement' => $this->requirement,
            'salary' => $cleanedSalary,
            'location' => $this->location,
            'deadline' => $this->deadline,
        ]);

        $taskPosting->save();

        // Attach the tags to the task
        $taskPosting->tags()->attach($this->selectedTags);

        // $this->resetFields();
        $this->reset();

        session()->flash('success', 'Task created successfully');

        return redirect()->route('task-posting-page');
    }
}
