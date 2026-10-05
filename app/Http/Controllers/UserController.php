<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $users = User::all();
        return response()->json($users, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'rol_id'              => 'required|exists:roles,id',
            'zona_id'             => 'required|exists:zonas,id',
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255|unique:users,email',
            'password'            => 'required|string|min:8',
            'puntos_totales'      => 'nullable|integer|min:0',
            'estado_onboarding'   => 'nullable|boolean',
            'estado_usuario'      => 'nullable|string|in:activo,inactivo,suspendido',
        ]);

        $user = User::create($validated);
        return response()->json($user, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
            'rol_id'            => 'sometimes|required|exists:roles,id',
            'zona_id'           => 'sometimes|required|exists:zonas,id',
            'name'              => 'sometimes|required|string|max:255',
            'email'             => 'sometimes|required|email|max:255|unique:users,email,' . $id,
            'password'          => 'nullable|string|min:8',
            'puntos_totales'    => 'sometimes|required|integer|min:0',
            'estado_onboarding' => 'sometimes|boolean',
            'estado_usuario'    => 'sometimes|string|in:activo,inactivo,suspendido',
            'ultimo_login'      => 'nullable|date',
    ]);

    // Si no se envía contraseña nueva en el update, no se sobrescribe
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

    $user->update($validated);

    return response()->json($user, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
