<?php

namespace App\Livewire\Admin\User\Modal;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class ConfirmationModal extends ModalComponent
{
    public $userId;
    public $action;

    public function mount($userId, $action)
    {
        $this->userId = $userId;
        $this->action = $action;
    }

    public function suspendOrUnsuspendUser()
    {
        $user = User::find($this->userId);

        if ($this->action === 'suspend') {
            $user->is_suspended = true;
            session()->flash('message', 'User has been suspended.');
        } elseif ($this->action === 'unsuspend') {
            $user->is_suspended = false;
            session()->flash('message', 'User has been unsuspended.');
        }

        $user->save();
        $this->dispatch('userStatusChanged');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.user.modal.confirmation-modal',[
            'action' => $this->action,
        ]);
    }
}
