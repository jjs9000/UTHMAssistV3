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

    public function mount()
    {
        // Retrieve the showUserTable state from the session
        $this->showUserTable = Session::get('showUserTable', true);
    }

    #[On('showUserTable')]
    public function showUserTable()
    {
        // Update the showUserTable state and store it in the session
        $this->showUserTable = true;
        Session::put('showUserTable', true);
    }

    #[On('showAddUserForm')]
    public function showAddUserForm()
    {
        // Update the showUserTable state and store it in the session
        $this->showUserTable = false;
        Session::put('showUserTable', false);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin-user', [
            'showUserTable' => $this->showUserTable
        ]);
    }
}
