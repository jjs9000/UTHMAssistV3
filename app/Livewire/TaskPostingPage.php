<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TaskPosting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskPostingPage extends Component
{
    use WithPagination;

    public $editTaskId;
    public $editTaskDetails;
    protected $listeners = ['taskDeleted' => '$refresh'];

    public function render()
    {
        $user = Auth::user();
        $postedTasks = TaskPosting::where('user_id', $user->id)->orderByDesc('created_at')->paginate(5);

        foreach ($postedTasks as $task) {
            $task->shortDiffForHumans = $this->getShortDiffForHumans($task->created_at);
        }

        return view('livewire.task-posting-page', [
            'postedTasks' => $postedTasks,
        ]);
    }

    public function editTask($taskId)
    {
        $task = TaskPosting::with('tags')->findOrFail($taskId);
        $this->editTaskId = $taskId;
        $this->editTaskDetails = $task;
    }

    public function cancelEdit()
    {
        $this->editTaskId = null;
        $this->editTaskDetails = null;
    }

    private function getShortDiffForHumans(Carbon $date)
    {
        return $date->diffForHumans([
            'parts' => 1,
            'short' => true,
            'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
        ]);
    }
}
