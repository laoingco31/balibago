<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        session()->regenerate();

        if (!Auth::check()) {
            throw ValidationException::withMessages([
                'email' => 'Login successful but session is not persisting!',
            ]);
        }

        return redirect()->route('dashboard');
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::lower($this->email) . '|' . request()->ip();
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}


?>

<div class="flex flex-col gap-6">
    <!-- Logo Section -->
    <div class="flex justify-center mb-4">
    <img src="{{ url('images/logo.png') }}" alt="App Logo" class="h-20 w-auto">

    </div>

    <!-- Authentication Header -->
    <x-auth-header title="Log in to your account" description="Enter your email and password below to log in" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <!-- Login Form -->
    <form wire:submit.prevent="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <input type="email" wire:model.defer="email" class="border rounded p-2 w-full" placeholder="Email address" required>

        <!-- Password -->
        <div class="relative">
            <input type="password" wire:model.defer="password" class="border rounded p-2 w-full" placeholder="Password" required>
        </div>

        <!-- Remember Me Checkbox -->
        <label class="flex items-center">
            <input type="checkbox" wire:model.defer="remember" class="mr-2"> Remember me
        </label>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-600 text-white p-2 rounded w-full">Log in</button>
    </form>

    <!-- Registration Link -->
    @if (Route::has('register'))
        <div class="text-center text-sm text-gray-600 mt-2">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600">Sign up</a>
        </div>
    @endif
</div>
