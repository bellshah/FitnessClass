<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotInstructor
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('instructor')->check()) {
            return redirect()->route('instructor.login');
        }

        return $next($request);
    }
} 