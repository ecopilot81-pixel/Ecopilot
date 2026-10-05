<?php

namespace App\Http\Controllers;

use App\Models\HistorialChat;
use Illuminate\Http\Request;

class HistorialChatController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $historiales = HistorialChat::all();
        return response()->json($historiales, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'pregunta_usuario'  =>    'required|string',
            'respuesta_bot'     =>    'required|string',
            'user_id'           =>    'required|exists:users,id',
        ]);

        $historial = HistorialChat::create($validated);
        return response()->json($historial, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $historial = HistorialChat::findOrFail($id);
        return response()->json($historial, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $historial = HistorialChat::findOrFail($id);

    $validated = $request->validate([
            'pregunta_usuario'  =>    'required|string',
            'respuesta_bot'     =>    'required|string',
            'user_id'           =>    'required|exists:users,id',
    ]);

    $historial->update($validated);

    return response()->json($historial, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $historial = HistorialChat::findOrFail($id);
        $historial->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
