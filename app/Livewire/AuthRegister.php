<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRegister extends Component
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;

    public function submit() {
        $this->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }

    public function render(){
        return view('livewire.auth-register');
    }
}
