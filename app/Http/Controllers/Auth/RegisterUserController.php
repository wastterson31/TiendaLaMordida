<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('UserRegisterView', ['user' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:8',
            'address' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'rol' => 'user', // Puedes establecer el rol según tus necesidades
        ]);

        return redirect()->route('login');
    }
}
