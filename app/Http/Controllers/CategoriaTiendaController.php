<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTienda;
use Illuminate\Http\Request;

class CategoriaTiendaController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {
        $categorias = CategoriaTienda::all();
        return response()->json($categorias, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categoria_tiendas,nombre',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|boolean',
        ]);

        $categorias = CategoriaTienda::create($validated);
        return response()->json($categorias, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {
        $categoria = CategoriaTienda::findOrFail($id);
        return response()->json($categoria, 200);
    }
    // ACTUALIZAR REGISTRO
    public function update(Request $request, $id) {
        
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:100|unique:categoria_tiendas,nombre,' . $id,
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|boolean',
        ]);

        $categoria = CategoriaTienda::findOrFail($id);

        $categoria->update($validated);

        return response()->json($categoria, 200);
    }
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {
        $categoria = CategoriaTienda::findOrFail($id);
        $categoria->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}