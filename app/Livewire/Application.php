<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Application as ApplicationModel;

class Application extends Component
{
    public $applications;

    public function mount()
    {
        // Fetch application data from the database
        $this->applications = ApplicationModel::all();
    }

    public function render()
    {
        return view('livewire.application');
    }
}
