<?php

namespace App\Http\Middleware;

use App\Models\Instructor;
use App\Models\Member;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $expectedClass = match ($role) {
            'member' => Member::class,
            'instructor' => Instructor::class,
            default => null,
        };

        if (! $expectedClass || ! $request->user() instanceof $expectedClass) {
            abort(403, 'This action is unauthorized for your account type.');
        }

        return $next($request);
    }
}
