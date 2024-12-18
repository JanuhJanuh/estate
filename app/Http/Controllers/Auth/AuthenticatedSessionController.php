<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        $request->session()->regenerate();

        $guard = session('auth_guard');

        $url = '';
        if($guard === 'admin'){
            $url = '/admin/dashboard';
        } elseif($guard === 'manager'){
            $url = '/manager/dashboard';
        } elseif($guard === 'tenant'){
            $url = '/tenant/dashboard';
        }

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
  /**
 * Destroy an authenticated session.
 */
public function destroy(Request $request): RedirectResponse
{
    // Retrieve the guard from the session
    $guard = session('auth_guard');

    if (!$guard) {
        // If guard is not set, log a warning or handle the case as needed
        return redirect('/')->with('error', 'Invalid session or already logged out.');
    }

    // Log out using the specified guard
    Auth::guard($guard)->logout();

    // Invalidate the session and regenerate CSRF token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to the home page or login page
    return redirect('/');
}

}
