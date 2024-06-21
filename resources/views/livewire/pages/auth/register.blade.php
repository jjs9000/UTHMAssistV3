<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Rules\UTHMStudentEmail;

new #[Layout('layouts.guest')] class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $date_of_birth = '';
    public string $contact_number = '';
    public string $address = '';
    public string $post_code = '';
    public string $city = '';
    public string $state = '';
    public string $ic = '';
    public $usertype = 'user';
    public $gender;
    public $currentStep = 1;

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

    public function validateStep1()
    {
        $this->validate([
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, new UTHMStudentEmail],
            'username' => ['required', 'string', 'max:15', 'unique:'.User::class],
        ]);

        $this->currentStep = 2;
    }

    public function validateStep2()
    {
        $this->validate([
            'contact_number' => 'required|string|max:12',
            'ic' => 'required|string|max:12',
            'date_of_birth' => 'required|date',
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
        ]);

        $this->currentStep = 3;
    }

    public function validateStep3()
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:25',
        ]);

        $this->currentStep = 4;
    }

    public function validateStep4()
    {
        $this->validate([
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required|string|same:password',
        ]);

        $this->register();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->validate([
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

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'usertype' => $this->usertype,
            'gender' => $this->gender,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
            'post_code' => $this->post_code,
            'state' => $this->state,
            'city' => $this->city,
            'ic' => $this->ic,
            'date_of_birth' => $this->date_of_birth,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
};
?>

{{-- <div>
    <form wire:submit.prevent="register" enctype="multipart/form-data">
        <!-- First Name, Last Name, Username side by side -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" autofocus autocomplete="first_name" />
            </div>

            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" autofocus autocomplete="last_name" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" autocomplete="username" />
            </div>
        </div>

        <!-- Email Address & Phone Number side by side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" />
            </div>

            <div>
                <x-input-label for="contact_number" :value="__('Contact Number')" />
                <x-text-input wire:model="contact_number" id="contact_number" class="block mt-1 w-full" type="tel" name="contact_number" autocomplete="contact_number" />
            </div>
        </div>

        <!-- IC, Date of Birth, Profile Picture side by side -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <x-input-label for="ic" :value="__('IC')" />
                <x-text-input wire:model="ic" id="ic" class="block mt-1 w-full" type="text" name="ic" autocomplete="ic" />
            </div>

            <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input wire:model="date_of_birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" autocomplete="date_of_birth" />
            </div>
            <div class="mb-4">
                <x-input-label for="gender" :value="__('Gender')" />
                <select wire:model="gender" id="gender" name="gender" class="mt-1 block border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="text-red-500" />
            </div>
        </div>

        <!-- Address as a textarea -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-textarea-input wire:model="address" id="address" class="block mt-1 w-full" name="address" autocomplete="address">{{ old('address') }}</x-textarea-input>
        </div>

        <!-- Post Code, State, and City side by side -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <x-input-label for="post_code" :value="__('Post Code')" />
                <x-text-input wire:model="post_code" id="post_code" class="block mt-1 w-full" type="text" name="post_code" autocomplete="post_code" />
            </div>

            <div>
                <x-input-label for="state" :value="__('State')" />
                <x-text-input wire:model="state" id="state" class="block mt-1 w-full" type="text" name="state" autocomplete="state" />
            </div>

            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" name="city" autocomplete="city" />
            </div>
        </div>

        <!-- Password & Confirm Password side by side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div> --}}

<div x-data="{ step: @entangle('currentStep') }">
    <form wire:submit.prevent="register" enctype="multipart/form-data">
        <div class="min-w-screen h-1/2 flex items-center justify-center px-5 py-5">
            <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
                <div class="md:flex w-full">
                    <div class="hidden md:block w-1/2 bg-white py-10 px-10">
                        <img src="{{ asset('svg/illustration/register-illustration.svg') }}" />
                    </div>
                    <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                        <div class="text-center mb-10">
                            <h1 class="font-bold text-3xl text-gray-900">REGISTER</h1>
                            <p>Enter your information to register</p>
                            <div class="mt-4 mb-4 flex items-center justify-between">
                                <span class="border-b w-1/2 lg:w-1/2"></span>
                                <p class="px-3">or</p>
                                <span class="border-b w-1/2 lg:w-1/2"></span>
                            </div>
                            <div class="flex flex-row justify-center items-center">
                                <p>Already have an account?</p>
                                <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                                    Log in
                                </a>
                            </div>
                        </div>
                        <div>
                            <!-- Step 1: Personal Information -->
                            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="first_name" :value="__('First Name')" />
                                        <x-text-input wire:model.defer="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" autofocus autocomplete="first_name" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="last_name" :value="__('Last Name')" />
                                        <x-text-input wire:model.defer="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" autofocus autocomplete="last_name" />
                                    </div>
                                </div>
                            
                                <div class="grid grid-cols-1 gap-4 mt-4">
                                    <div>
                                        <x-input-label for="username" :value="__('Username')" />
                                        <x-text-input wire:model.defer="username" id="username" class="block mt-1 w-full" type="text" name="username" autocomplete="username" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input wire:model.defer="email" id="email" class="block mt-1 w-full" type="email" name="email" placeholder="e.g. @student.uthm.edu.my" />
                                    </div>
                                </div>
                            
                                <div class="flex items-center justify-end mt-4">
                                    <button type="button" class="ml-4 bg-gray-900 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold" @click="$wire.validateStep1()">
                                        Next
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Additional Information -->
                            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                <div class="grid grid-cols-1 gap-4 mt-4">
                                    <div>
                                        <x-input-label for="contact_number" :value="__('Contact Number')" />
                                        <x-text-input wire:model.defer="contact_number" id="contact_number" class="block mt-1 w-full" type="tel" name="contact_number" autocomplete="contact_number" placeholder="e.g. 01xxxxxxxx" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="ic" :value="__('IC')" />
                                        <x-text-input wire:model.defer="ic" id="ic" class="block mt-1 w-full" type="text" name="ic" autocomplete="ic" placeholder="e.g. 000xxxxxxxxx" />
                                    </div>
                                </div>
                            
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                        <x-text-input wire:model.defer="date_of_birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" autocomplete="date_of_birth" onkeydown="return false" />
                                    </div>
                            
                                    <div class="mb-4">
                                        <x-input-label for="gender" :value="__('Gender')" />
                                        <select wire:model.defer="gender" id="gender" name="gender" class="mt-1 block border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="text-red-500" />
                                    </div>
                                </div>
                            
                                <div class="flex items-center justify-between mt-4">
                                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold" @click="step = 1">
                                        Previous
                                    </button>
                                    <button type="button" class="bg-gray-900 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold" @click="$wire.validateStep2()">
                                        Next
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Address Information -->
                            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                <div class="grid grid-cols-1 gap-4 mt-4">
                                    <div>
                                        <x-input-label for="address" :value="__('Address')" />
                                        <x-textarea-input wire:model.defer="address" id="address" class="block mt-1 w-full" name="address" autocomplete="address">{{ old('address') }}</x-textarea-input>
                                    </div>
                            
                                    <div>
                                        <x-input-label for="post_code" :value="__('Post Code')" />
                                        <x-text-input wire:model.defer="post_code" id="post_code" class="block mt-1 w-full" type="text" name="post_code" autocomplete="post_code" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="city" :value="__('City')" />
                                        <x-text-input wire:model.defer="city" id="city" class="block mt-1 w-full" type="text" name="city" autocomplete="city" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="state" :value="__('State')" />
                                        <x-text-input wire:model.defer="state" id="state" class="block mt-1 w-full" type="text" name="state" autocomplete="state" />
                                    </div>
                                </div>
                            
                                <div class="flex items-center justify-between mt-4">
                                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold" @click="step = 2">
                                        Previous
                                    </button>
                                    <button type="button" class="bg-gray-900 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold" @click="$wire.validateStep3()">
                                        Next
                                    </button>
                                </div>
                            </div>

                            <!-- Step 4: Password Information -->
                            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                <div class="grid grid-cols-1 gap-4 mt-4">
                                    <div>
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input wire:model.defer="password" id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input wire:model.defer="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                                    </div>
                                </div>
                            
                                <div class="flex items-center justify-between mt-4">
                                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold" @click="step = 3">
                                        Previous
                                    </button>
                                    <button type="submit" class="bg-gray-900 hover:bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

