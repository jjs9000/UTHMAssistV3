<?php

namespace App\Livewire\Admin\Rating;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $showRatingTable;
    public bool $isModalOpen = false;

    public function mount()
    {
        $this->showRatingTable = Session::get('showRatingTable', true);
    }

    #[On('showRatingTable')]
    public function showRatingTable()
    {
        if (!$this->isModalOpen) {
            $this->showRatingTable = true;
            Session::put('showRatingTable', true);
        }
    }

    #[On('showTagForm')]
    public function showTagForm()
    {
        if (!$this->isModalOpen) {
            $this->showRatingTable = false;
            Session::put('showRatingTable', false);
            $this->resetPage();
        }
    }

    public function handleModalClosed()
    {
        $this->isModalOpen = false;
    }

    public function handleModalOpened()
    {
        $this->isModalOpen = true;
    }

    public function render()
    {
        return view('livewire.admin.rating.index',[
            'showRatingTable' => $this->showRatingTable,
        ]);
    }
}
