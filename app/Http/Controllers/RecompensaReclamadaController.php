<?php

namespace App\Http\Controllers;

use App\Models\RecompensaReclamada;
use Illuminate\Http\Request;

class RecompensaReclamadaController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $recompensas = RecompensaReclamada::all();
        return response()->json($recompensas, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'user_id'           => 'required|exists:users,id',
            'pase_temporada_id' => 'required|exists:pase_temporadas,id',
            'fecha_reclamo'     => 'nullable|date',
        ]);

        $recompensa = RecompensaReclamada::create($validated);
        return response()->json($recompensa, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $recompensa = RecompensaReclamada::findOrFail($id);
        return response()->json($recompensa, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $recompensa = RecompensaReclamada::findOrFail($id);

    $validated = $request->validate([
            'user_id'           => 'sometimes|required|exists:users,id',
            'pase_temporada_id' => 'sometimes|required|exists:pase_temporadas,id',
            'fecha_reclamo'     => 'nullable|date',
    ]);

    $recompensa->update($validated);

    return response()->json($recompensa, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $recompensa = RecompensaReclamada::findOrFail($id);
        $recompensa->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
