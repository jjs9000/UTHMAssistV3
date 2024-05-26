<?php

namespace App\Livewire\Admin\Application;

use App\Models\Application;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicationTable extends Component
{
    use WithPagination;

    public $status;

    protected $listeners = ['applicationDeleted' => '$refresh'];

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
        } else {
            $this->sortBy = $sortByField;
        }
    }

    public function render()
    {
        return view('livewire.admin.application.application-table', [
            'applications' => Application::query()
                ->when($this->search, function($query) {
                    $query->whereHas('user', function($q) {
                        $q->where('username', 'like', "%{$this->search}%");
                    })->orWhereHas('task', function($q) {
                        $q->where('title', 'like', "%{$this->search}%");
                    });
                })
                ->when($this->status, function ($query) {
                    $query->where('status', $this->status);
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
