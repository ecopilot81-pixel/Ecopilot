<?php

namespace App\Http\Controllers;

use App\Models\ProgresoPase;
use Illuminate\Http\Request;

class ProgresoPaseController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $progresos = ProgresoPase::all();
        return response()->json($progresos, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'experiencia'    =>    'nullable|integer|min:0',
            'nivel_actual'   =>    'nullable|integer|min:1',
            'es_premium'     =>    'nullable|boolean',
            'user_id'        =>    'required|exists:users,id|unique:progreso_pases,user_id',
        ]);

        

        $progreso = ProgresoPase::create($validated);
        return response()->json($progreso, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $progreso = ProgresoPase::findOrFail($id);
        return response()->json($progreso, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $progreso = ProgresoPase::findOrFail($id);

    $validated = $request->validate([
            'experiencia'    =>    'nullable|integer|min:0',
            'nivel_actual'   =>    'nullable|integer|min:1',
            'es_premium'     =>    'nullable|boolean',
            'user_id'      => 'required|exists:users,id|unique:progreso_pases,user_id,' . $id,
    ]);

    $progreso->update($validated);

    return response()->json($progreso, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $progreso = ProgresoPase::findOrFail($id);
        $progreso->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
