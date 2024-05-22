<?php

namespace App\Livewire\Admin\Tag\Modal;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class DeleteConfirmationModal extends ModalComponent
{
    public $tagId;

    public function mount($tagId)
    {
        $this->tagId = $tagId;
    }

    public function deleteUser()
    {
        $tag = Tag::find($this->tagId);

        if ($tag) {
            $tag->delete();
            session()->flash('message', 'User deleted successfully.');
            $this->dispatch('tagDeleted');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.tag.modal.delete-confirmation-modal');
    }
}
