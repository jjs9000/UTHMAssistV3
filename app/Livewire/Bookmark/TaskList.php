<?php

namespace App\Livewire\Bookmark;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    protected $listeners = ['taskUnsaved' => '$refresh'];

    public function render()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())->paginate(5);

        $noBookmarkAvailable = $bookmarks->isEmpty();

        return view('livewire.bookmark.task-list',[
            'bookmarks' => $bookmarks,
            'noBookmarkAvailable' => $noBookmarkAvailable,
        ]);
    }

    #[On('redirectToTaskPostingShow')]
    public function redirectToTaskPostingShow()
    {
        $taskId = $this->bookmarks->taskPosting->id;
        $url = route('task-posting.show', ['id' => $taskId]);
        
        // Open the URL in a new tab using JavaScript
        $script = "<script>window.open('{$url}', '_blank')</script>";
        return $script;
    }
}
