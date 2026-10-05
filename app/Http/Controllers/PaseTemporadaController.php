<?php

namespace App\Http\Controllers;

use App\Models\PaseTemporada;
use Illuminate\Http\Request;

class PaseTemporadaController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $pases = PaseTemporada::all();
        return response()->json($pases, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'nivel_requerido'       =>    'required|integer|min:0',
            'tipo_pase'             =>    'nullable|in:gratis,premium',
            'cantidad_recompensa'   =>    'nullable|integer|min:1',
            'temporada'             =>    'required|string|max:100',
            'tienda_item_id'        =>    'required|exists:tienda_items,id',
        ]);

        $pase = PaseTemporada::create($validated);
        return response()->json($pase, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $pase = PaseTemporada::findOrFail($id);
        return response()->json($pase, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $pase = PaseTemporada::findOrFail($id);

    $validated = $request->validate([
            'nivel_requerido'       =>    'required|integer|min:0',
            'tipo_pase'             =>    'nullable|in:gratis,premium',
            'cantidad_recompensa'   =>    'nullable|integer|min:1',
            'temporada'             =>    'required|string|max:100',
            'tienda_item_id'        =>    'required|exists:tienda_items,id', 
    ]);

    $pase->update($validated);

    return response()->json($pase, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $pase = PaseTemporada::findOrFail($id);
        $pase->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}


