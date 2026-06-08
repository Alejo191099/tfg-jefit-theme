<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Enseño la pantalla de inicio de sesión
        return view('login');
    }

    public function login(Request $request)
    {
        // Compruebo que el email y la contraseña vienen bien escritos
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intento iniciar sesión con los datos del formulario
        if (Auth::attempt($credenciales)) {
            // Regenero la sesión por seguridad después de iniciar sesión
            $request->session()->regenerate();

            /*
                Si el usuario es administrador, lo mando al panel.
                Si es usuario normal, lo mando a sus compras.
            */
            if (auth()->user()->rol === 'admin') {
                return redirect()->route('admin.index');
            }

            return redirect()->route('usuario.compras');
        }

        // Si los datos no coinciden, vuelvo al formulario con un mensaje de error
        return back()
            ->withErrors(['email' => 'El correo o la contraseña son incorrectos.'])
            ->onlyInput('email');
    }

    public function showRegister()
    {
        // Enseño el formulario para crear una cuenta nueva
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Valido los datos antes de crear el usuario
        $datos = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Creo el usuario como usuario normal, no como administrador
        $usuario = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'rol' => 'user',
        ]);

        // Inicio sesión automáticamente después del registro
        Auth::login($usuario);

        // Regenero la sesión por seguridad
        $request->session()->regenerate();

        return redirect()
            ->route('usuario.compras')
            ->with('success', 'Cuenta creada correctamente.');
    }

    public function logout(Request $request)
    {
        // Cierro la sesión del usuario actual
        Auth::logout();

        // Limpio la sesión para que no queden datos antiguos guardados
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}