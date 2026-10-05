<?php

namespace App\Http\Controllers;

use App\Models\RegistroReciclaje;
use Illuminate\Http\Request;

class RegistroReciclajeController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $registros = RegistroReciclaje::all();
        return response()->json($registros, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'user_id'              => 'required|exists:users,id',
            'tipo_material_id'     => 'required|exists:tipo_materiales,id',
            'punto_recoleccion_id' => 'required|exists:punto_recoleciones,id',
            'cantidad'             => 'required|numeric|min:0.01',
            'puntos_ganados'       => 'required|integer|min:0',
            'estado'               => 'nullable|string|in:pendiente,completado,rechazado',
        ]);

        $registro = RegistroReciclaje::create($validated);
        return response()->json($registro, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $registro = RegistroReciclaje::findOrFail($id);
        return response()->json($registro, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $registro = RegistroReciclaje::findOrFail($id);

    $validated = $request->validate([
            'user_id'              => 'sometimes|required|exists:users,id',
            'tipo_material_id'     => 'sometimes|required|exists:tipo_materiales,id',
            'punto_recoleccion_id' => 'sometimes|required|exists:punto_recoleciones,id',
            'cantidad'             => 'sometimes|required|numeric|min:0.01',
            'puntos_ganados'       => 'sometimes|required|integer|min:0',
            'estado'               => 'sometimes|required|string|in:pendiente,completado,rechazado',
    ]);

    $registro->update($validated);

    return response()->json($registro, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $registro = RegistroReciclaje::findOrFail($id);
        $registro->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}

