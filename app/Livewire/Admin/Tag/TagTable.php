<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TagTable extends Component
{
    use WithPagination;

    protected $listeners = ['tagDeleted' => '$refresh', 'tagUpdated' => '$refresh', 'showViewTagModal', 'openViewTagModal'];

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function openViewTagModal($tagId)
    {
        $this->dispatch('openModal', 'view-tag-modal', ['tag' => $tagId]);
        $this->dispatch('admin-tag', 'modalOpened');
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
        }

        $this->sortBy = $sortByField;
    }

    public function render()
    {
        return view('livewire.admin.tag.tag-table', [
            'tags' => Tag::query()
                ->when($this->search, function($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                          ->orWhere('description', 'like', "%{$this->search}%");
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
