<?php

namespace App\Livewire\Admin\Application;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $showApplicationTable;
    public bool $isModalOpen = false;

    public function mount()
    {
        $this->showApplicationTable = Session::get('showApplicationTable', true);
    }

    #[On('showApplicationTable')]
    public function showApplicationTable()
    {
        if (!$this->isModalOpen) {
            $this->showApplicationTable = true;
            Session::put('showApplicationTable', true);
        }
    }

    #[On('showTagForm')]
    public function showTagForm()
    {
        if (!$this->isModalOpen) {
            $this->showApplicationTable = false;
            Session::put('showApplicationTable', false);
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
        return view('livewire.admin.application.index',[
            'showApplicationTable' => $this->showApplicationTable,
        ]);
    }
}
