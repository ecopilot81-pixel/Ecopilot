<?php

namespace App\Http\Controllers;

use App\Models\MaterialPorPunto;
use Illuminate\Http\Request;

class MaterialPorPuntoController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $materiales = MaterialPorPunto::all();
        return response()->json($materiales, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'tipo_material_id'      =>    'required|exists:tipo_materiales,id',
            'punto_recolecion_id'   =>    'required|exists:punto_recoleciones,id',
            'disponible'            =>    'nullable|boolean',
            'fecha_vinculacion'     =>    'nullable|date',
        ]);

        $material = MaterialPorPunto::create($validated);
        return response()->json($material, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $material = MaterialPorPunto::findOrFail($id);
        return response()->json($material, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $material = MaterialPorPunto::findOrFail($id);

    $validated = $request->validate([
            'tipo_material_id'      =>    'required|exists:tipo_materiales,id',
            'punto_recolecion_id'   =>    'required|exists:punto_recoleciones,id',
            'disponible'            =>    'nullable|boolean',
            'fecha_vinculacion'     =>    'nullable|date',
    ]);

    $material->update($validated);

    return response()->json($material, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $material = MaterialPorPunto::findOrFail($id);
        $material->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}



