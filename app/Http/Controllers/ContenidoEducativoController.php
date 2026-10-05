<?php

namespace App\Http\Controllers;

use App\Models\ContenidoEducativo;
use Illuminate\Http\Request;

class ContenidoEducativoController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $contenidos = ContenidoEducativo::all();
        return response()->json($contenidos, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'titulo'                =>     'required|string|max:255|unique:contenido_educativos,titulo',
            'tipo_publico'          =>     'required|string|max:255',
            'tipo_formato'          =>     'required|string|max:255',
            'descripcion'           =>     'required|string',
            'url_recurso'           =>     'nullable|string|url|max:255',
            'user_id'               =>     'nullable|exists:users,id',
            'categoria_global_id'   =>     'required|exists:categoria_globals,id',
        ]);

        $contenido = ContenidoEducativo::create($validated);
        return response()->json($contenido, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $contenido = ContenidoEducativo::findOrFail($id);
        return response()->json($contenido, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $contenido = ContenidoEducativo::findOrFail($id);

    $validated = $request->validate([
            'titulo'              => 'sometimes|required|string|max:255|unique:contenido_educativos,titulo,' . $id,
            'tipo_publico'        => 'sometimes|required|string|max:255',
            'tipo_formato'        => 'sometimes|required|string|max:255',
            'descripcion'         => 'sometimes|required|string',
            'url_recurso'         => 'nullable|string|url|max:255',
            'user_id'             => 'nullable|exists:users,id',
            'categoria_global_id' => 'sometimes|required|exists:categoria_globals,id',
    ]);

    $contenido->update($validated);

    return response()->json($contenido, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $contenido = ContenidoEducativo::findOrFail($id);
        $contenido->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}

