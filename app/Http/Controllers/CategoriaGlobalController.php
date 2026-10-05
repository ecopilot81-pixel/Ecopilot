<?php

namespace App\Http\Controllers;

use App\Models\CategoriaGlobal;
use Illuminate\Http\Request;

class CategoriaGlobalController extends Controller
{ // METODO MOSTAR TODO LOS DATOS
    public function index() {
        $categorias = CategoriaGlobal::all();
        return response()->json($categorias, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categoria_globals,nombre',
            'icono' => 'nullable|string|:max:255',
        ]);

        $categorias = CategoriaGlobal::create($validated);
        return response()->json($categorias, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {
        $categoria = CategoriaGlobal::findOrFail($id);
        return response()->json($categoria, 200);
    }
    // ACTUALIZAR REGISTRO
    public function update(Request $request, $id) {

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:100|unique:categoria_globals,nombre,' . $id,
            'icono' => 'nullable|string|max:255',
        ]);

        $categoria = CategoriaGlobal::findOrFail($id);
        $categoria->update($validated);

        return response()->json($categoria, 200);
    }
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {
        $categoria = CategoriaGlobal::findOrFail($id);
        $categoria->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}