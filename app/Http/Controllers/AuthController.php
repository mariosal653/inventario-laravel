<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar login
    public function processLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
            'remember' => 'nullable'
        ]);

        $credentials = ['email' => $data['email'], 'password' => $data['password']];

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Regenerar sesión para evitar fixation
            $request->session()->regenerate();
            return redirect()->intended(route('products.index'));
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
