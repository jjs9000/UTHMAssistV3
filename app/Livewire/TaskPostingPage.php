<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TaskPosting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TaskPostingPage extends Component
{
    use WithPagination;

    public function render()
    {   
        $user = Auth::user();
        $postedTasks = TaskPosting::where('user_id', $user->id)->orderByDesc('created_at')->paginate(5);

        return view('livewire.task-posting-page', [
            'postedTasks' => $postedTasks,
        ]);
    }

    public function deleteTask($taskId)
    {
        $task = TaskPosting::findOrFail($taskId);
        $task->delete();
    
        // Fetch the updated list of tasks after deletion
        $user = Auth::user();
        $postedTasks = TaskPosting::where('user_id', $user->id)->paginate(5);

        // Pass the updated list of tasks to the view
        $this->render(); // Rerender the component

        // Flash a success message
        Session::flash('success', 'Task deleted successfully');
    }
}
