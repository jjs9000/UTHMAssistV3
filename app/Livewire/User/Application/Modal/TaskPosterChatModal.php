<?php

namespace App\Livewire\User\Application\Modal;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TaskPosterChatModal extends ModalComponent
{
    public $applicationId;
    public $userName;
    public $applicantName;
    public $taskPosterName;
    public $hasName;
    public $isApplicantConnected;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->loadNames();
        $this->userName = Auth::user()->name;
        $this->hasName = !empty($this->userName);
    }

    public function loadNames()
    {
        $application = Application::with('user', 'task.user')->find($this->applicationId);
        if ($application) {
            $this->applicantName = $application->user->name ?? 'No name provided';
            $this->taskPosterName = $application->task->user->name ?? 'No name provided';
            $this->isApplicantConnected = !empty($application->user->name);
        }
    }

    public function updateUserName()
    {
        $this->validate([
            'userName' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $this->userName;
        $user->save();

        $this->hasName = true;
        $this->redirectToMessages();
    }

    public function redirectToMessages()
    {
        return redirect('/messages');
    }

    public function render()
    {
        return view('livewire.user.application.modal.task-poster-chat-modal');
    }
}
