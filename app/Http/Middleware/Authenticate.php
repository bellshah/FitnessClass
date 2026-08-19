<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        return match ($request->route()?->getPrefix()) {
            'member' => route('member.login'),
            'instructor' => route('instructor.auth.login'),
            default => '/',
        };
    }
}
