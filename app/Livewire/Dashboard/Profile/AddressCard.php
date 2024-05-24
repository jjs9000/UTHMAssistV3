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

    protected $messages = [
        'address.required' => 'Please enter your address',
        'address.max' => 'The address is too long. Maximum 50 characters.',
        'state.required' => 'Please enter your state.',
        'state.max' => 'The state is too long. Maximum 25 characters.',
        'city.required' => 'Please enter your city.',
        'city.max' => 'The city is too long. Maximum 25 characters.',
        'post_code.required' => 'Please enter your post code.',
        'post_code.max' => 'The post code is too long. Maximum 25 characters.',
    ];

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
        // Validation rules
        $this->validate([
            'address' => 'required|max:50',
            'state' => 'required|max:25',
            'city' => 'required|max:25',
            'post_code' => 'required|max:25',
        ]);

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
