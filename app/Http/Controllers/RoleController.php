<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $roles = Role::all();
        return response()->json($roles, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|boolean',
        ]);

        $role = Role::create($validated);
        return response()->json($role, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $role = Role::findOrFail($id);
        return response()->json($role, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $role = Role::findOrFail($id);

    $validated = $request->validate([
        'nombre'        => 'required|string|max:50|unique:roles,nombre,' . $id,
        'descripcion' => 'nullable|string',
        'estado'        => 'nullable|boolean',
    ]);

    $role->update($validated);

    return response()->json($role, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
