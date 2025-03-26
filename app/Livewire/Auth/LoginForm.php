<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', __('These credentials do not match our records.'));
            return;
        }

        session()->regenerate();
        return redirect()->route('dashboard'); // Palitan mo ng tamang route
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
