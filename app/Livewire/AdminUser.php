<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUser extends Component
{
    use WithPagination;

    public bool $showUserTable = true;

    #[On('showUserTable')]
    public function showUserTable()
    {
        $this->showUserTable = true;
    }

    #[On('showAddUserForm')]
    public function showAddUserForm()
    {
        $this->showUserTable = false;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin-user', [
            'showUserTable' => $this->showUserTable
        ]);
    }
}
