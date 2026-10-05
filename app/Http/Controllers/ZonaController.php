<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $zonas = Zona::all();
        return response()->json($zonas, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:zonas,nombre',
            'codigo_postal' => 'nullable|string|max:20',
            'estado' => 'nullable|boolean',
        ]);

        $zonas = Zona::create($validated);
        return response()->json($zonas, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $zona = Zona::findOrFail($id);
        return response()->json($zona, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $zona = Zona::findOrFail($id);

    $validated = $request->validate([
        'nombre'        => 'required|string|max:100|unique:zonas,nombre,' . $id,
        'codigo_postal' => 'nullable|string|max:20',
        'estado'        => 'nullable|boolean',
    ]);

    $zona->update($validated);

    return response()->json($zona, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $zona = Zona::findOrFail($id);
        $zona->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
