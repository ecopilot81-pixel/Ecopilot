<?php

namespace App\Http\Controllers;

use App\Models\EstadoArbole;
use Illuminate\Http\Request;

class EstadoArboleController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $estados = EstadoArbole::all();
        return response()->json($estados, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'nivel_crecimiento'     =>     'nullable|integer|min:1',
            'moneda_virtual_saldo'  =>     'nullable|integer|min:0',
            'ultima_interaccion'    =>     'nullable|date',
            'user_id'               =>     'required|exists:users,id',
        ]);
        $estado = EstadoArbole::create($validated);
        return response()->json($estado, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $estado = EstadoArbole::findOrFail($id);
        return response()->json($estado, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $estado = EstadoArbole::findOrFail($id);

    $validated = $request->validate([
            'nivel_crecimiento'     =>     'nullable|integer|min:1',
            'moneda_virtual_saldo'  =>     'nullable|integer|min:0',
            'ultima_interaccion'    =>     'nullable|date',
            'user_id'               =>     'sometimes|required|exists:users,id',
    ]);

    $estado->update($validated);

    return response()->json($estado, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $estado = EstadoArbole::findOrFail($id);
        $estado->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
