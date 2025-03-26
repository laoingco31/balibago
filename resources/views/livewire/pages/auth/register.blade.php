<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div class="">
    
    <div class="">
        
        <h2 class="text-3xl font-bold text-center mb-6">Register</h2>

        <form wire:submit="register" class="space-y-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-white"/>
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2" type="text" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400"/>
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white"/>
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2" type="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400"/>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-white"/>
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2" type="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400"/>
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white"/>
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full rounded-lg bg-white/20 text-white border border-white/30 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 px-4 py-2" type="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400"/>
            </div>

            <div class="flex items-center justify-between">
                <a class="text-sm text-indigo-200 hover:text-indigo-300 underline" href="{{ route('login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="px-6 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
