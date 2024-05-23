<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminAddUserForm extends Component
{
    public $username;
    public $first_name;
    public $last_name;
    public $ic;
    public $email;
    public string $password;
    public string $password_confirmation;
    public $usertype;
    public $date_of_birth;
    public $contact_number;
    public $address;
    public $post_code;
    public $city;
    public $state;

    public function saveUser()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ic' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', Rule::in(['user', 'admin'])],
            'date_of_birth' => 'nullable|date',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
    
        // Create the user
        User::create($validatedData);
    
        // Redirect to the user-table component with success message
        session()->flash('success', 'User created successfully!');
        return redirect()->route('admin-user');
    }

    public function render()
    {
        return view('livewire.admin-add-user-form');
    }
}
