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

    /**
     * Handle an incoming registration request.
     */
     public function register(): void
    {
        $validated = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', Rule::in(['user', 'admin'])],
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'ic' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit.prevent="register" enctype="multipart/form-data">
        <!-- First Name, Last Name, Username side by side -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>
        </div>

        <!-- Address as a textarea -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-textarea-input wire:model="address" id="address" class="block mt-1 w-full" name="address" required autocomplete="address">{{ old('address') }}</x-textarea-input>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Email Address & Phone Number side by side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="contact_number" :value="__('Contact Number')" />
                <x-text-input wire:model="contact_number" id="contact_number" class="block mt-1 w-full" type="tel" name="contact_number" required autocomplete="contact_number" />
                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
            </div>
        </div>

        <!-- IC, Date of Birth, Profile Picture side by side -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <x-input-label for="ic" :value="__('IC')" />
                <x-text-input wire:model="ic" id="ic" class="block mt-1 w-full" type="text" name="ic" required autocomplete="ic" />
                <x-input-error :messages="$errors->get('ic')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input wire:model="date_of_birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" required autocomplete="date_of_birth" />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
            </div>
        </div>

        <!-- Post Code, State, and City side by side -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <x-input-label for="post_code" :value="__('Post Code')" />
                <x-text-input wire:model="post_code" id="post_code" class="block mt-1 w-full" type="text" name="post_code" required autocomplete="post_code" />
                <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="state" :value="__('State')" />
                <x-text-input wire:model="state" id="state" class="block mt-1 w-full" type="text" name="state" required autocomplete="state" />
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" name="city" required autocomplete="city" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
        </div>

        <!-- Password & Confirm Password side by side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
</div>

