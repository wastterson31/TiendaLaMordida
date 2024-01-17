<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationSessionController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = $request->user();

            return response()->json([
                'token' => $user->createToken($request->name)->plainTextToken,
                'name' => $user->name,
                'username' => $user->username,
                'rol' => $user->rol,
                'id' => $user->id,
                'message' => 'Success',
            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                'message' => 'No autorizado',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->currentAccessToken()->delete();
            return response()->json([
                'message' => 'logged out',
            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                'message' => 'user no autenticado',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function register(Request $request)
    {
        $user = new User([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'rol' => $request->rol
        ]);
        $user->save();

        return response()->json([
            'message' => 'User registered',
            'data' => $user
        ], Response::HTTP_ACCEPTED);
    }
}
