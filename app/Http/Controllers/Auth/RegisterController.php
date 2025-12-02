<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegistrationForm() {
        //view baru khusus register
        return view('auth.register');
    }
    
}