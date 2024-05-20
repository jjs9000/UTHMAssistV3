<?php

namespace App\Livewire\Bookmark;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class UnsaveConfirmationModal extends ModalComponent
{
    public $taskId;

    public function mount($taskId)
    {
        $this->taskId = $taskId;
    }

    public function unsaveTask()
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
                            ->where('task_posting_id', $this->taskId)
                            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $this->dispatch('taskUnsaved', $this->taskId);
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.bookmark.unsave-confirmation-modal');
    }
}
