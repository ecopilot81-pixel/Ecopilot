<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $reseña = Feedback::all();
        return response()->json($reseña, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'puntuacion'      =>    'required|integer|min:1|max:5',
            'comentario'      =>    'nullable|string',
            'version_app'     =>    'nullable|string|max:50',
            'estado_visible'  =>    'nullable|boolean',
            'user_id'         =>    'required|exists:users,id'
        ]);

        $reseña = Feedback::create($validated);
        return response()->json($reseña, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $reseña = Feedback::findOrFail($id);
        return response()->json($reseña, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $reseña = Feedback::findOrFail($id);

    $validated = $request->validate([
            'puntuacion'      =>    'sometimes|required|integer|min:1|max:5',
            'comentario'      =>    'nullable|string',
            'version_app'     =>    'nullable|string|max:50',
            'estado_visible'  =>    'nullable|boolean',
            'user_id'         =>    'sometimes|required|exists:users,id'
    ]);

    $reseña->update($validated);

    return response()->json($reseña, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $reseña = Feedback::findOrFail($id);
        $reseña->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
