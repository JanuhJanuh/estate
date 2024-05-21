<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'manager':
                        return redirect('/manager/dashboard');
                    case 'tenant':
                        return redirect('/tenant/dashboard');
                    case 'admin':
                        return redirect('/admin/dashboard');
                }
            }
        }

        return $next($request);
    }
}

