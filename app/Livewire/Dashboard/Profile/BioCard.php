<?php

namespace App\Livewire\Dashboard\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BioCard extends Component
{
    public $bio;
    public $isEditing = false;

    protected $messages = [
        'bio.string' => 'The bio must be in type string.',
        'bio.max' => 'The bio is too long. Maximum 1000 words.',
    ];

    public function mount()
    {
        $this->bio = Auth::user()->bio;
    }

    public function editBio()
    {
        $this->isEditing = true;
    }

    public function saveBio()
    {
        $this->validate([
            'bio' => 'string|max:1000',
        ]);

        $user = Auth::user();
        $user->bio = $this->bio;
        $user->save();

        $this->isEditing = false;

        session()->flash('message', 'Bio updated successfully.');
    }

    public function render()
    {
        return view('livewire.dashboard.profile.bio-card');
    }
}
