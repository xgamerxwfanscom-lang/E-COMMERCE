<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function formulario()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required'
        ]);

        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->clave,
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            Log::channel('autenticacion')->info('Login exitoso', [
                'correo' => $request->correo,
                'ip' => $request->ip()
            ]);

            return redirect('/dashboard');
        }

        Log::channel('autenticacion')->warning('Login incorrecto', [
            'correo' => $request->correo,
            'ip' => $request->ip()
        ]);

        return back()->withErrors([
            'correo' => 'Credenciales incorrectas'
        ])->onlyInput('correo');
    }

    public function logout(Request $request)
    {
        Log::channel('autenticacion')->info('Logout', [
            'usuario_id' => Auth::id(),
            'ip' => $request->ip()
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}