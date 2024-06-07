<?php

namespace App\Livewire\Admin\Rating;

use App\Models\Feedback;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class RatingTable extends Component
{
    use WithPagination;

    protected $listeners = ['feedbackDeleted' => '$refresh', 'feedbackUpdated' => '$refresh', 'showViewFeedbackModal', 'openViewFeedbackModal'];

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

    public function render()
    {
        return view('livewire.admin.rating.rating-table', [
            'feedbacks' => Feedback::query()
                ->when($this->search, function($query) {
                    $query->where('id', 'like', "%{$this->search}%")
                          ->orWhere('task_id', 'like', "%{$this->search}%")
                          ->orWhere('user_id', 'like', "%{$this->search}%")
                          ->orWhere('rating', 'like', "%{$this->search}%")
                          ->orWhere('comment', 'like', "%{$this->search}%");
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
