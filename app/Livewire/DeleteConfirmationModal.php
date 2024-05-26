<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\TaskPosting;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class DeleteConfirmationModal extends ModalComponent
{
    public $userId;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function deleteUser()
    {
        $user = User::find($this->userId);

        if ($user) {
            TaskPosting::where('user_id', $this->userId)->delete();
            Application::where('user_id', $this->userId)->delete();
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
            $this->dispatch('userDeleted');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-confirmation-modal');
    }
}
