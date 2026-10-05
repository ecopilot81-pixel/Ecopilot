<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $noticias = Noticia::all();
        return response()->json($noticias, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'titulo'                =>    'required|string|max:255',
            'resumen'               =>    'required|string',
            'contenido'             =>    'required|string',
            'imagen_destacada'      =>    'nullable|string|string|max:255',
            'fuente'                =>    'nullable|string|max:255',
            'url_fuente'            =>    'nullable|string|url|max:255',
            'estado_noticia'        =>    'nullable|string|max:50',
            'user_id'               =>    'nullable|exists:users,id',
            'categoria_global_id'   =>    'required|exists:categoria_globals,id',
        ]);

        $noticia = Noticia::create($validated);
        return response()->json($noticia, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $noticia = Noticia::findOrFail($id);
        return response()->json($noticia, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $noticia = Noticia::findOrFail($id);

    $validated = $request->validate([
            'titulo'                =>    'required|string|max:255',
            'resumen'               =>    'required|string',
            'contenido'             =>    'required|string',
            'imagen_destacada'      =>    'nullable|string|string|max:255',
            'fuente'                =>    'nullable|string|max:255',
            'url_fuente'            =>    'nullable|string|url|max:255',
            'estado_noticia'        =>    'nullable|string|max:50',
            'user_id'               =>    'nullable|exists:users,id',
            'categoria_global_id'   =>    'required|exists:categoria_globals,id',
    ]);

    $noticia->update($validated);

    return response()->json($noticia, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $noticia = Noticia::findOrFail($id);
        $noticia->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
