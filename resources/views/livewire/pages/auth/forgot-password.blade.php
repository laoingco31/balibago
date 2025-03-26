<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    $status = Password::sendResetLink($this->only('email'));

    if ($status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));
        return;
    }

    $this->reset('email');
    Session::flash('status', __($status));
};

?>

<div class="">
    
    <div class="">
        
        <h2 class="text-3xl font-bold text-center mb-6">Forgot Password</h2>

        <p class="mb-6 text-center text-white/80">
            {{ __('Forgot your password? No problem. Just enter your email and we will send you a password reset link.') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-green-400 font-semibold" :status="session('status')" />

        <form wire:submit="sendPasswordResetLink" class="space-y-6">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white"/>
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2" type="email" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400"/>
            </div>

            <div class="flex items-center justify-between">
                <a class="text-sm text-indigo-200 hover:text-indigo-300 underline" href="{{ route('login') }}" wire:navigate>
                    {{ __('Back to Login') }}
                </a>

                <x-primary-button class="px-6 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    {{ __('Send Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
