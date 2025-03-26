<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();
    $this->form->authenticate();
    Session::regenerate();
    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div class="">
    <div class="">
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form wire:submit="login" class="space-y-6">
            
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white"/>
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-400"/>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-white"/>
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-400"/>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-white/30 bg-transparent text-indigo-300 focus:ring-indigo-400">
                <label for="remember" class="ms-2 text-sm text-white">{{ __('Remember me') }}</label>
            </div>

            <!-- Login Button & Forgot Password -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-200 hover:text-indigo-300 underline">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="px-6 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>



