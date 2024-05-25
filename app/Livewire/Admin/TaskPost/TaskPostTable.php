<?php

namespace App\Livewire\Admin\TaskPost;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\TaskPosting;
use Carbon\Carbon;

class TaskPostTable extends Component
{
    use WithPagination;

    public $location;
    public $status;

    protected $listeners = ['taskDeleted' => '$refresh'];

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

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
        }

        $this->sortBy = $sortByField;
    }

    public function getFormattedDateOfBirth($deadline)
    {
        return Carbon::parse($deadline)->format('d F Y');
    }

    public function render()
    {
        return view('livewire.admin.task-post.task-post-table',[
            'taskPosts' => TaskPosting::query()
                ->when($this->location, function ($query) {
                    $query->where('location', $this->location);
                })
                ->when($this->status, function ($query) {
                    $query->where('status', $this->status);
                })
                ->when($this->search, function($query) {
                    $query->where('title', 'like', "%{$this->search}%");
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
