<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationSessionController extends Controller
{
    public function create()
    {
        return view('auth.Login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|string|email|max:255|min:8',
                'password' => 'required|string'
            ]
        );

        //Incorrecto, genera excepción y retorna al formulario de login
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Autenticación incorrecta'
                ]
            );
        }
        $request->session()->regenerate();
        return redirect()->route('welcomeAdmin');
    }

    public function destroy(Request $request)
    {
        //Destruir el archivo de sesión
        $request->session()->invalidate();
        //opener un nuevo token
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
