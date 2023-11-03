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
        return view('UserLoginView');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => 'required',
                'password' => 'required|string'
            ]
        );
        //dd($credentials);

        //Incorrecto, genera excepción y retorna al formulario de login
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(
                [
                    'username' => 'Autenticación incorrecta'
                ]
            );
        }
        $request->session()->regenerate();
        return redirect()->route('Admin');
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
