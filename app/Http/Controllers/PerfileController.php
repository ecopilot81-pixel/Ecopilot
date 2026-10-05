<?php

namespace App\Http\Controllers;

use App\Models\Perfile;
use Illuminate\Http\Request;

class PerfileController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $perfiles = Perfile::all();
        return response()->json($perfiles, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'nombre'       =>    'required|string|max:50',
            'apellido'     =>    'required|string|max:50',
            'alias'        =>    'nullable|string|max:50|unique:perfiles,alias',
            'telefono'     =>    'nullable|string|max:20',
            'ciudad'       =>    'nullable|string|max:100',
            'foto_perfil' =>     'nullable|string|max:255',
            'biografia'   =>     'nullable|string',
            'user_id'     =>     'required|exists:users,id|unique:perfiles,user_id',
        ]);

        $perfil = Perfile::create($validated);
        return response()->json($perfil, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $perfil = Perfile::findOrFail($id);
        return response()->json($perfil, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $perfil = Perfile::findOrFail($id);

    $validated = $request->validate([
            'nombre'      => 'required|string|max:50',
            'apellido'    => 'required|string|max:50',
            'alias'       => 'nullable|string|max:50|unique:perfiles,alias,' . $id,
            'telefono'    => 'nullable|string|max:20',
            'ciudad'      => 'nullable|string|max:100',
            'foto_perfil' => 'nullable|string|max:255',
            'biografia'   => 'nullable|string',
            'user_id'     => 'required|exists:users,id|unique:perfiles,user_id,' . $id 
    ]);

    $perfil->update($validated);

    return response()->json($perfil, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $perfil = Perfile::findOrFail($id);
        $perfil->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
