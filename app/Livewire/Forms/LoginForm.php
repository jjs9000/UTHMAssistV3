<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $identity = ''; // Updated field name to 'identity'

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Check if the identity is an email address
        if (filter_var($this->identity, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $this->identity];
        } else {
            $credentials = ['username' => $this->identity];
        }

        // Attempt to find the user by email or username
        $user = \App\Models\User::where($credentials)->first();

        // Check if the user exists and is suspended
        if ($user && $user->is_suspended) {
            throw ValidationException::withMessages([
                'identity' => trans('Your account has been suspended. Please contact administrator.'),
            ]);
        }

        // Attempt to authenticate with either email or username
        if (! Auth::attempt(array_merge($credentials, ['password' => $this->password]), $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'identity' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->identity).'|'.request()->ip());
    }
}
