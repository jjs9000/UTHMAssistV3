<?php

namespace App\Livewire\Dashboard\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfilePictureCard extends Component
{

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.dashboard.profile.profile-picture-card', [
            'user' => $this->user,
        ]);
    }
}
