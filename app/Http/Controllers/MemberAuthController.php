<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MemberAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('member.login');
    }

    public function showRegistrationForm()
    {
        return view('member.register');
    }
} 