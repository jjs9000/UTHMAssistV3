<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public function render()
    {
        $user = Auth::user();

        return view('livewire.dashboard.profile',[
            'user' => $user,
        ]);
    }
}
