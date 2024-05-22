<?php

namespace App\Livewire\Admin\Tag;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $showTagTable;
    public bool $isModalOpen = false;

    public function mount()
    {
        $this->showTagTable = Session::get('showTagTable', true);
    }

    #[On('showTagTable')]
    public function showTagTable()
    {
        if (!$this->isModalOpen) {
            $this->showTagTable = true;
            Session::put('showTagTable', true);
        }
    }

    #[On('showTagForm')]
    public function showTagForm()
    {
        if (!$this->isModalOpen) {
            $this->showTagTable = false;
            Session::put('showTagTable', false);
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
        return view('livewire.admin.tag.index',[
            'showTagTable' => $this->showTagTable,
        ]);
    }
}
