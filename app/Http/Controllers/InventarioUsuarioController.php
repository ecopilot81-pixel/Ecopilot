<?php

namespace App\Http\Controllers;

use App\Models\InventarioUsuario;
use Illuminate\Http\Request;

class InventarioUsuarioController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $inventario = InventarioUsuario::all();
        return response()->json($inventario, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'user_id'          =>    'required|exists:users,id',
            'tienda_item_id'   =>    'required|exists:tienda_items,id',
            'cantidad'         =>    'required|integer|min:1',
        ]);

        $inventario = InventarioUsuario::create($validated);
        return response()->json($inventario, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $inventario = InventarioUsuario::findOrFail($id);
        return response()->json($inventario, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $inventario = InventarioUsuario::findOrFail($id);

    $validated = $request->validate([
            'user_id'          =>    'required|exists:users,id',
            'tienda_item_id'   =>    'required|exists:tienda_items,id',
            'cantidad'         =>    'required|integer|min:1',
    ]);

    $inventario->update($validated);

    return response()->json($inventario, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $inventario = InventarioUsuario::findOrFail($id);
        $inventario->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
