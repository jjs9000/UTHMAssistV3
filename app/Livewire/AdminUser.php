<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class AdminUser extends Component
{
    use WithPagination;

    public bool $showUserTable;
    public bool $isModalOpen = false;

    protected $listeners = [
        'viewUserModalClosed' => 'handleModalClosed',
        'modalOpened' => 'handleModalOpened'
    ];

    public function mount()
    {
        $this->showUserTable = Session::get('showUserTable', true);
    }

    #[On('showUserTable')]
    public function showUserTable()
    {
        if (!$this->isModalOpen) {
            $this->showUserTable = true;
            Session::put('showUserTable', true);
        }
    }

    #[On('showAddUserForm')]
    public function showAddUserForm()
    {
        if (!$this->isModalOpen) {
            $this->showUserTable = false;
            Session::put('showUserTable', false);
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
        return view('livewire.admin-user', [
            'showUserTable' => $this->showUserTable
        ]);
    }
}
