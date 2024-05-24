<?php

namespace App\Livewire\Dashboard\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalCard extends Component
{
    public $first_name;
    public $last_name;
    public $ic;
    public $contact_number;
    public $editingField = '';

    protected $messages = [
        'first_name.required' => 'Please enter your first name.',
        'first_name.max' => 'First name is too long. Maximum 20 characters.',
        'last_name.required' => 'Please enter your last name.',
        'last_name.max' => 'Last name is too long. Maximum 20 characters.',
        'ic.required' => 'Please enter your identification card.',
        'ic.max' => 'Identification card is too long. Maximum 12 characters.',
        'contact_number.required' => 'Please enter your contact number.',
        'contact_number.max' => 'Contact number is too long. Maximum 11 characters.',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->ic = $user->ic;
        $this->contact_number = $user->contact_number;
    }

    public function startEditing($field)
    {
        $this->editingField = $field;
    }

    public function save()
    {
        $this->validate([
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'ic' => 'required|max:12',
            'contact_number' => 'required|max:11',
        ]);

        $user = Auth::user();
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'ic' => $this->ic,
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
