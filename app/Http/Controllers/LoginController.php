<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = [
            "email" => $request->login,
            "password" => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/home');
        }

        return back()->withErrors([
            'email' => 'Usuario o contraseña son incorrectos',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login()
    {
        return view('auth.login');
    }
}
