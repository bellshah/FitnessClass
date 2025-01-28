<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('instructor.auth.login');
    }

    public function showRegisterForm()
    {
        return view('instructor.auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('instructor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('instructor.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:instructors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $instructor = \App\Models\Instructor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('instructor')->login($instructor);

        return redirect()->route('instructor.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 