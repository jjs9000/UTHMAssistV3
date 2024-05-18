<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;


class ViewMyApplicationModal extends ModalComponent
{
    public Application $application;

    public function mount($applicationId)
    {
        $this->application = Application::findOrFail($applicationId);
    }

    public function render(): View
    {
        return view('livewire.view-my-application-modal', [
            'application' => $this->application,
        ]);
    }
}
