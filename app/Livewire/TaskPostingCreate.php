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
    public $location_detail;
    public $deadline;
    public $status;
    public $availability;
    public $selectedTags = [];

    public $task;

    protected $messages = [
        'title.required' => 'Please enter the title.',
        'title.max' => 'The title is too long. Maximum 50 characters',
        'description.required' => 'Please enter the description.',
        'description.max' => 'The description is too long. Maximum 150 characters',
        'requirement.required' => 'Please enter the requirement.',
        'requirement.max' => 'The requirement is too long. Maximum 150 characters.',
        'salary.required' => 'Please enter the salary.',
        'location.required' => 'Please select a location.',
        'location_detail.required' => 'Please enter the location detail.',
        'location_detail.max' => 'The location detail is too long. Maximum 100 characters.',
        'status.required' => 'Please set the status.',
        'deadline.required' => 'Please enter the deadline.',
        'deadline.date' => 'The deadline must be a valid date.',
        'deadline.after' => 'The deadline must be a date after today.',
        'availability.required' => 'Please enter the availability.',
    ];

    public function mount($task = null)
    {
        $this->task = $task;

        if ($task) {
            $this->title = $task['title'];
            $this->description = $task['description'];
            $this->requirement = $task['requirement'];
            $this->salary = $task['salary'];
            $this->location = $task['location'];
            $this->location_detail = $task['location_detail'];
            $this->deadline = $task['deadline'];
            $this->status = $task['status'];
            $this->availability = $task['availability'];
            $this->selectedTags = $task->tags->pluck('id')->toArray();
        }
    }

    public function createTask()
    {
        // Validation rules
        $rules = [
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'requirement' => 'required|max:150',
            'salary' => 'required',
            'location' => 'required',
            'location_detail' => 'required|max:150',
            'status' => 'required',
            'deadline' => 'required|date|after:today',
            'availability' => 'required',
        ];

        // Validate the request
        $this->validate($rules);

        // Clean and cast salary to a decimal
        $cleanedSalary = filter_var(str_replace(['RM', ','], '', $this->salary), FILTER_VALIDATE_FLOAT);

        // Create or update the task posting
        if ($this->task) {
            $task = TaskPosting::findOrFail($this->task->id);
            $task->update([
                'title' => $this->title,
                'description' => $this->description,
                'requirement' => $this->requirement,
                'salary' => $cleanedSalary,
                'location' => $this->location,
                'location_detail' => $this->location_detail,
                'status' => $this->status,
                'deadline' => $this->deadline,
                'availability' => $this->availability,
            ]);
            $task->tags()->sync($this->selectedTags);
            $message = 'Task updated successfully.';
        } else {
            $task = TaskPosting::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'requirement' => $this->requirement,
                'salary' => $cleanedSalary,
                'location' => $this->location,
                'location_detail' => $this->location_detail,
                'status' => $this->status,
                'deadline' => $this->deadline,
                'availability' => $this->availability,
            ]);
            $task->tags()->attach($this->selectedTags);
            $message = 'Task created successfully.';
        }

        // Reset fields
        $this->reset();

        session()->flash('success', $message);

        // Redirect to task posting page
        return redirect()->route('task-posting-page');
    }

    public function render()
    {
        $tags = Tag::all();
        return view('livewire.task-posting-create', [
            'tags' => $tags,
        ]);
    }
}
