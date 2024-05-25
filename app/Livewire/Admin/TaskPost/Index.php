<?php

namespace App\Livewire\Admin\TaskPost;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $showTaskPostTable;
    public bool $isModalOpen = false;

    public function mount()
    {
        $this->showTaskPostTable = Session::get('showTaskPostTable', true);
    }

    #[On('showTaskPostTable')]
    public function showTaskPostTable()
    {
        if (!$this->isModalOpen) {
            $this->showTaskPostTable = true;
            Session::put('showTaskPostTable', true);
        }
    }

    #[On('showTaskPostForm')]
    public function showTaskPostForm()
    {
        if (!$this->isModalOpen) {
            $this->showTaskPostTable = false;
            Session::put('showTaskPostTable', false);
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
        return view('livewire.admin.task-post.index',[
            'showTaskPostTable' => $this->showTaskPostTable,
        ]);
    }
}
