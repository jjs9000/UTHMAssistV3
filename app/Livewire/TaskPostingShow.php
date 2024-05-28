<?php

namespace App\Livewire;

use App\Models\Bookmark;
use Livewire\Component;
use App\Models\TaskPosting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class TaskPostingShow extends Component
{
    public $task;
    public $savedTask;
    public $savedTaskIds = [];

    public function mount($id)
    {
        $this->task = TaskPosting::findOrFail($id);
    }

    public function toggleBookmark($taskId)
    {
        $this->savedTask = TaskPosting::find($taskId);

        if (in_array($taskId, $this->savedTaskIds)) {
            Bookmark::where('user_id', Auth::id())
                    ->where('task_posting_id', $taskId)
                    ->delete();
            $this->savedTaskIds = array_diff($this->savedTaskIds, [$taskId]);
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'task_posting_id' => $taskId,
            ]);
            $this->savedTaskIds[] = $taskId;
        }
    }

    public function render()
    {
        $this->savedTaskIds = Bookmark::where('user_id', Auth::id())
                                           ->pluck('task_posting_id')
                                           ->toArray();
                                           
        return view('livewire.task-posting-show',[
            'savedTask' => $this->savedTask,
            'savedTaskIds' => $this->savedTaskIds,
        ]);
    }

    #[On('apply')]
    public function apply()
    {
        // Redirect the user to the ApplicationCreateForm component
        return redirect()->route('application-create-form', [
            'taskId' => $this->task->id,
        ]);
    }
}
