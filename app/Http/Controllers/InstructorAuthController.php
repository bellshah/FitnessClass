<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class InstructorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('instructor.login');
    }

    public function showRegistrationForm()
    {
        return view('instructor.register');
    }
} 