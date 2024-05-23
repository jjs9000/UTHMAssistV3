<?php

namespace App\Livewire\Dashboard\Modal;

use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ProfilePictureModal extends ModalComponent
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.dashboard.modal.profile-picture-modal',[
            'user' => $this->user,
        ]);
    }
}
