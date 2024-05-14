<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ViewUserModal extends ModalComponent
{
    public User $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render(): View
    {
        return view('livewire.view-user-modal');
    }
}
