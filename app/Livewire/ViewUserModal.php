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

    public function closeUserModal()
    {
        $this->dispatch('viewUserModalClosed');
        $this->closeModal();  // Call the existing method from LivewireUI\Modal\ModalComponent
    }

    public function render(): View
    {
        return view('livewire.view-user-modal',[
            'user' => $this->user,   
        ]);
    }
}
