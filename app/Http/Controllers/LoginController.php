<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'NOMBRE' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user->Auth::user();
            $request->session()->regenerate();
            return redirect('/inicio');
        }

        return back()->withErrors([
            'login' => 'Usuario o contraseña son incorrectos',
        ])->onlyInput('login');
    }

    public function login()
    {
        return view('login.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
