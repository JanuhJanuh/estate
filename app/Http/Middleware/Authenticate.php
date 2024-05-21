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

        // Redirect to login based on the guard
        $guard = $request->route()->middleware();
        if (in_array('auth:admin', $guard)) {
            return route('login');
        } elseif (in_array('auth:manager', $guard)) {
            return route('login');
        } elseif (in_array('auth:tenant', $guard)) {
            return route('login');
        }

        return route('login');
    }
}

