<?php

namespace App\Livewire\Dashboard\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalCard extends Component
{
    public $first_name;
    public $last_name;
    public $username;
    public $ic;
    public $email;
    public $contact_number;
    public $editingField = '';

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->ic = $user->ic;
        $this->email = $user->email;
        $this->contact_number = $user->contact_number;
    }

    public function startEditing($field)
    {
        $this->editingField = $field;
    }

    public function save()
    {
        $user = Auth::user();
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'ic' => $this->ic,
            'email' => $this->email,
            'contact_number' => $this->contact_number,
        ]);

        $this->editingField = '';

        session()->flash('message', 'Personal details updated successfully.');
    }

    public function render()
    {
        return view('livewire.dashboard.profile.personal-card');
    }
}
