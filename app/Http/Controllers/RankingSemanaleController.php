<?php

namespace App\Http\Controllers;

use App\Models\RankingSemanale;
use Illuminate\Http\Request;

class RankingSemanaleController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $rankings = RankingSemanale::all();
        return response()->json($rankings, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'puntos_semanales'  =>    'nullable|integer|min:0',
            'posicion'          =>    'nullable|integer|min:1',
            'fecha_inicio'      =>    'required|date',
            'fecha_fin'        =>     'required|date|after_or_equal:fecha_inicio',
            'recompensa'        =>    'nullable|string|max:255',
            'user_id'           =>    'required|exists:users,id',
        ]);

        $ranking = RankingSemanale::create($validated);
        return response()->json($ranking, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $ranking = RankingSemanale::findOrFail($id);
        return response()->json($ranking, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $ranking = RankingSemanale::findOrFail($id);

    $validated = $request->validate([
            'puntos_semanales'  =>    'nullable|integer|min:0',
            'posicion'          =>    'nullable|integer|min:1',
            'fecha_inicio'      =>    'required|date',
            'fecha_fin'        =>     'required|date|after_or_equal:fecha_inicio',
            'recompensa'        =>    'nullable|string|max:255',
            'user_id'           =>    'required|exists:users,id',
    ]);

    $ranking->update($validated);

    return response()->json($ranking, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $ranking = RankingSemanale::findOrFail($id);
        $ranking->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
