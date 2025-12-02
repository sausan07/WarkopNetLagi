<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //untuk menampilkan halaman
    public function showLoginForm() {
        return view('auth.login');
    }
    
    public function logout() {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}