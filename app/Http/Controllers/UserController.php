<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validaciones
        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:6'
        ]);

        // Actualizar correo
        $user->email = $request->email;

        // Actualizar contraseña solo si se envió
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.show')->with('success', 'Perfil actualizado correctamente');
    }
}
