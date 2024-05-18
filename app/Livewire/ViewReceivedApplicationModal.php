<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ViewReceivedApplicationModal extends ModalComponent
{
    public Application $application;

    public function mount($application)
    {
        $this->application = $application;
    }

    public function render(): View
    {
        return view('livewire.view-received-application-modal');
    }
}
