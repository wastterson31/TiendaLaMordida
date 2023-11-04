<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $user = User::where('username', $request->username)->get()[0];

        $request->session()->regenerate();
        if ($user->rol == 'admin') {
            return redirect()->route('Admin');
        } else {
            return redirect()->route('Home');
        }
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
