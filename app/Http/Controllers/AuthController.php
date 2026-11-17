<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 3, // Rol usuario por defecto
            'zona_id' => $request->zona_id ?? 1, // Por defecto sector norte
            'puntos_totales' => 0,
            'estado_usuario' => 'activo',
        ]);

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->where('estado_usuario', 'activo')
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesion exitoso',
            'token' => $token,
            'user' => $user->only([
                'id',
                'name',
                'email',
                'puntos_totales',
                'estado_usuario',
            ]),
        ], 200);
    }

    // Revoca el token Bearer utilizado por la solicitud actual.
    public function logout(Request $request) {
        $token = $request->user()->currentAccessToken();
        if (!$token instanceof PersonalAccessToken) {
            return response()->json([
                'message' => 'No se encontró un token personal para revocar.',
            ], 400);
        }

        $token->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ]);
    }
}
