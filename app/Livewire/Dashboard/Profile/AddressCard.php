<?php

namespace App\Livewire\Dashboard\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressCard extends Component
{
    public $address;
    public $state;
    public $city;
    public $post_code;
    public $editingField = '';

    public function mount()
    {
        $user = Auth::user();
        $this->address = $user->address;
        $this->state = $user->state;
        $this->city = $user->city;
        $this->post_code = $user->post_code;
    }

    public function startEditing($field)
    {
        $this->editingField = $field;
    }

    public function save()
    {
        $user = Auth::user();
        $user->update([
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'post_code' => $this->post_code,
        ]);

        $this->editingField = '';

        session()->flash('message', 'Address details updated successfully.');
    }

    public function render()
    {
        return view('livewire.dashboard.profile.address-card');
    }
}
