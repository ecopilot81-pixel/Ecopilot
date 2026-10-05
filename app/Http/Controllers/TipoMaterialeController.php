<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoMateriale;

class TipoMaterialeController extends Controller
{
    // OBTENER TODOS (GET /api/tipos-materiales)
    public function index() {
        $materiales = TipoMateriale::all();
        return response()->json($materiales, 200);
    }

    // CREAR UN REGISTRO (POST /api/tipos-materiales)
    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:tipo_materiales,nombre',
            'valor_puntos' => 'required|integer|min:0',
            'unidad_medidas' => 'required|string|max:20',
            'instrucciones' => 'nullable|string',
            'icono' => 'nullable|string|max:255',
        ]);

        $material = TipoMateriale::create($validated);

        return response()->json($material, 201);   // 201 Created es el código HTTP correcto para creación
    }

    // MOSTRAR UNO SOLO (GET /api/tipos-materiales/{id})
    public function show($id) {

        $material = TipoMateriale::findOrFail($id);
        return response()->json($material, 200);
    }

    // ACTUALIZAR (PUT/PATCH /api/tipos-materiales/{id})
    public function update(Request $request, $id) {
        $material = TipoMateriale::findOrFail($id);
        $material->update($request->all());
        return response()->json($material, 200);
    }

    // ELIMINAR (DELETE /api/tipos-materiales/{id})

    public function destroy($id) {
        $material = TipoMateriale::findOrFail($id);
        $material->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}


