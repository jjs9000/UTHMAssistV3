<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Rules\UTHMStudentEmail;

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
    public $gender;

    protected $messages = [
        'first_name.required' => 'The first name is required.',
        'first_name.string' => 'The first name must be a string.',
        'first_name.max' => 'The first name must not be greater than 25 characters.',
        
        'last_name.required' => 'The last name is required.',
        'last_name.string' => 'The last name must be a string.',
        'last_name.max' => 'The last name must not be greater than 25 characters.',
        
        'email.required' => 'The email address is required.',
        'email.string' => 'The email address must be a string.',
        'email.lowercase' => 'The email address must be in lowercase.',
        'email.email' => 'The email address must be a valid email address.',
        'email.max' => 'The email address must not be greater than 255 characters.',
        'email.unique' => 'The email address has already been taken.',
        
        'username.required' => 'The username is required.',
        'username.string' => 'The username must be a string.',
        'username.max' => 'The username must not be greater than 15 characters.',
        'username.unique' => 'The username has already been taken.',
        
        'password.required' => 'The password is required.',
        'password.string' => 'The password must be a string.',
        'password.confirmed' => 'The password confirmation does not match.',
        
        'usertype.required' => 'The user type is required.',
        'usertype.string' => 'The user type must be a string.',
        'usertype.in' => 'The user type must be either user or admin.',
        
        'gender.required' => 'The gender is required.',
        'gender.string' => 'The gender must be a string.',
        'gender.in' => 'The gender must be either male or female.',
        
        'contact_number.required' => 'The contact number is required.',
        'contact_number.string' => 'The contact number must be a string.',
        'contact_number.max' => 'The contact number must not be greater than 12 characters.',
        
        'address.required' => 'The address is required.',
        'address.string' => 'The address must be a string.',
        'address.max' => 'The address must not be greater than 255 characters.',
        
        'post_code.required' => 'The post code is required.',
        'post_code.string' => 'The post code must be a string.',
        'post_code.max' => 'The post code must not be greater than 20 characters.',
        
        'state.required' => 'The state is required.',
        'state.string' => 'The state must be a string.',
        'state.max' => 'The state must not be greater than 25 characters.',
        
        'city.required' => 'The city is required.',
        'city.string' => 'The city must be a string.',
        'city.max' => 'The city must not be greater than 50 characters.',
        
        'ic.required' => 'The IC number is required.',
        'ic.string' => 'The IC number must be a string.',
        'ic.max' => 'The IC number must not be greater than 12 characters.',
        
        'date_of_birth.required' => 'The date of birth is required.',
        'date_of_birth.date' => 'The date of birth must be a valid date.',
    ];

    public function saveUser()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, new UTHMStudentEmail],
            'username' => ['required', 'string', 'max:15', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', Rule::in(['user', 'admin'])],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'contact_number' => 'required|string|max:12',
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'state' => 'required|string|max:25',
            'city' => 'required|string|max:50',
            'ic' => 'required|string|max:12',
            'date_of_birth' => 'required|date',
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
