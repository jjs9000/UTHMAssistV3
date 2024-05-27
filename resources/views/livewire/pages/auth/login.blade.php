<?php

use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
     public function login(): void
    {
        $this->validate();

        try {
            $this->form->authenticate();

            Session::regenerate();

            $authenticatedUser = Auth::user();

            if ($authenticatedUser && $authenticatedUser->usertype == 'admin') {
                $this->redirect('admin/dashboard');
            } else {
                $this->redirect(route('task-posting.index'));
            }
        } catch (ValidationException $e) {
            $this->addError('form.identity', $e->getMessage());
        }
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address/ Username -->
        <div>
            <x-input-label for="identity" :value="__('Email or Username')" />
            <x-text-input wire:model="form.identity" id="identity" class="block mt-1 w-full" type="text" name="identity" autofocus />
            @error('form.identity')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            autocomplete="current-password" />
            @error('form.password')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded  border-gray-300  text-indigo-600 shadow-sm focus:ring-indigo-500  " name="remember">
                <span class="ms-2 text-sm text-gray-600 ">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Or Label and Create Account Link -->
        <div class="flex items-center justify-center mt-4">
            <span class="text-sm text-gray-600">{{ __('or') }}</span>
        </div>
        <div class="flex items-center justify-center mt-2">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}" wire:navigate>
                {{ __('Create an account') }}
            </a>
        </div>
    </form>
</div>
