<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Enseña la pantalla donde se escribe el email y la contraseña.
    public function showLogin()
    {
        return view('login');
    }

    // Comprueba los datos del formulario de login.
    public function login(Request $request)
    {
        // Primero valido que el email tenga formato correcto y que la contraseña no venga vacía.
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Auth::attempt compara el email y la contraseña con los usuarios de la base de datos.
        if (Auth::attempt($credenciales)) {
            // Regenero la sesión por seguridad después de iniciar sesión.
            $request->session()->regenerate();

            // Si veníamos de una zona privada, vuelve ahí. Si no, manda al inicio.
            return redirect()->intended(route('inicio'));
        }

        // Si los datos no coinciden, vuelve al formulario y conserva el email escrito.
        return back()
            ->withErrors(['email' => 'El correo o la contraseña son incorrectos.'])
            ->onlyInput('email');
    }

    // Cierra la sesión del usuario actual.
    public function logout(Request $request)
    {
        Auth::logout();

        // Limpio la sesión para que no queden datos antiguos guardados.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}
