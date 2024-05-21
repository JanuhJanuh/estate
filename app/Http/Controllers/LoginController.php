<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Managers;
use App\Models\User;
use App\Models\Tenants;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($this->attemptLogin($request, 'admin')) {
            return redirect()->intended('/admin/dashboard');
        } elseif ($this->attemptLogin($request, 'manager')) {
            return redirect()->intended('/manager/dashboard');
        } elseif ($this->attemptLogin($request, 'tenant')) {
            return redirect()->intended('/tenant/dashboard');
        }

        
        return $this->sendFailedLoginResponse($request);
    }

    // Attempt to log the user in
    protected function attemptLogin(Request $request, $guard)
    {
        $credentials = $request->only('id_number', 'password');

        switch ($guard) {
            case 'manager':
                $user = Managers::where('IDNumber', $credentials['id_number'])->first();
                break;
            case 'tenant':
                $user = Tenants::where('IDNumber', $credentials['id_number'])->first();
                break;
            case 'admin':
            default:
                $user = User::where('NationalID', $credentials['id_number'])->first();
                break;
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::guard($guard)->login($user, $request->filled('remember'));
            return true;
        }

        return false;
    }

    // Send failed login response
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'id_number' => [trans('auth.failed')],
        ]);
    }

    // Log the user out
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
