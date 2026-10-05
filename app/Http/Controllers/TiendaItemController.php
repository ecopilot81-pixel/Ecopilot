<?php

namespace App\Http\Controllers;

use App\Models\TiendaItem;
use Illuminate\Http\Request;

class TiendaItemController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $items = TiendaItem::all();
        return response()->json($items, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'categoria_tienda_id'     => 'required|exists:categoria_tiendas,id',
            'nombre_item'             => 'required|string|max:255|unique:tienda_items,nombre_item',
            'descripcion_beneficio'   => 'nullable|string',
            'costo_moneda_virtual'    => 'required|integer|min:0',
            'stock'                   => 'required|integer|min:0',
            'imagen_item'             => 'nullable|string',
        ]);

        $item = TiendaItem::create($validated);
        return response()->json($item, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $item = TiendaItem::findOrFail($id);
        return response()->json($item, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $item = TiendaItem::findOrFail($id);

    $validated = $request->validate([
            'categoria_tienda_id'     => 'sometimes|required|exists:categoria_tiendas,id',
            'nombre_item'             => 'sometimes|required|string|max:255|unique:tienda_items,nombre_item' . $id,
            'descripcion_beneficio'   => 'nullable|string',
            'costo_moneda_virtual'    => 'sometimes|required|integer|min:0',
            'stock'                   => 'sometimes|required|integer|min:0',
            'imagen_item'             => 'nullable|string',
    ]);

    $item->update($validated);

    return response()->json($item, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $item = TiendaItem::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
