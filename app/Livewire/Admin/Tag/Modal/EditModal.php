<?php

namespace App\Livewire\Admin\Tag\Modal;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public $tagId;
    public $name;
    public $description;

    public function mount($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $this->tagId = $tag->id;
        $this->name = $tag->name;
        $this->description = $tag->description;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $tag = Tag::findOrFail($this->tagId);
        $tag->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('tagUpdated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.tag.modal.edit-modal');
    }
}
