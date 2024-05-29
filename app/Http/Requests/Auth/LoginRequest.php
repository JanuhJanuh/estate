<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'IDNumber' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('IDNumber', 'password');

        $guards = [
            'admin' => 'users', // Adjusted to match the provider
            'manager' => 'managers',
            'tenant' => 'tenants',
            'web' => 'users',
        ];

        foreach ($guards as $role => $provider) {
            if (Auth::guard($role)->attempt($credentials)) {
                $this->session()->put('auth_guard', $role);
                return Auth::guard($role)->user();
            }
        }

        throw ValidationException::withMessages([
            'IDNumber' => [trans('auth.failed')],
        ]);
    }
}
