<?php

namespace App\Http\Controllers;

use App\Models\PuntoRecolecione;
use Illuminate\Http\Request;

class PuntoRecolecioneController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index() {

        $puntos = PuntoRecolecione::all();
        return response()->json($puntos, 200);
    }
    // CREAR UN REGISTRO 
    public function store(Request $request) {

        $validated = $request->validate([
            'nombre_lugar'     => 'required|string|max:255',
            'direccion'        => 'required|string|max:255',
            'latitud'          => 'required|numeric|between:-90,90',
            'longitud'         => 'required|numeric|between:-180,180',
            'telefono'         => 'nullable|string|max:20',
            'horario_atencion' => 'required|string|max:255',
            'estado_punto'     => 'nullable|string|in:activo,inactivo',
            'administrador_id' => 'required|exists:users,id',
            'zona_id'          => 'required|exists:zonas,id',
        ]);

        $punto = PuntoRecolecione::create($validated);
        return response()->json($punto, 201);
    }
    // MOSTRAR UN SOLO REGISTRO
    public function show($id) {

        $punto = PuntoRecolecione::findOrFail($id);
        return response()->json($punto, 200);
    }
    // ACTUALIZAR REGISTRO
public function update(Request $request, $id) 
{
    $punto = PuntoRecolecione::findOrFail($id);

    $validated = $request->validate([
            'nombre_lugar'     => 'sometimes|required|string|max:255',
            'direccion'        => 'sometimes|required|string|max:255',
            'latitud'          => 'sometimes|required|numeric|between:-90,90',
            'longitud'         => 'sometimes|required|numeric|between:-180,180',
            'telefono'         => 'nullable|string|max:20',
            'horario_atencion' => 'sometimes|required|string|max:255',
            'estado_punto'     => 'nullable|string|in:activo,inactivo',
            'administrador_id' => 'sometimes|required|exists:users,id',
            'zona_id'          => 'sometimes|required|exists:zonas,id',
    ]);

    $punto->update($validated);

    return response()->json($punto, 200);
}
    // ELIMINIAR UN REGISTRO 
    public function destroy($id) {

        $punto = PuntoRecolecione::findOrFail($id);
        $punto->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
