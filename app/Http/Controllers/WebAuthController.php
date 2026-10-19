<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    // Inicia la sesión web después de validar las credenciales y el estado activo.
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Verifica las credenciales y que la cuenta esté activa; si falla, responde con error 422.
        if (!Auth::attempt($credentials + ['estado_usuario' => 'activo'])) {
            return response()->json([
                'message' => 'El correo o la contraseña no son válidos.',
            ], 422);
        }

        $request->session()->regenerate();

        return response()->json([
            'user' => $this->userData($request),
        ]);
    }

    // Devuelve únicamente los datos públicos básicos del usuario autenticado.
    public function currentUser(Request $request): JsonResponse
    {
        return response()->json($this->userData($request));
    }

    // Devuelve solo el perfil y los totales asociados al usuario de la sesión.
    public function currentProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $profile = $user->perfil;

        return response()->json([
            'user' => $this->userData($request),
            'profile' => $profile?->only([
                'nombre',
                'apellido',
                'alias',
                'ciudad',
                'biografia',
                'foto_perfil',
            ]),
            'stats' => [
                'recyclingRecords' => $user->registrosReciclaje()->count(),
                'claimedRewards' => $user->recompensasReclamadas()->count(),
            ],
        ]);
    }

    // Devuelve el inventario y las recompensas reclamadas por el usuario autenticado.
    public function currentCollection(Request $request): JsonResponse
    {
        $user = $request->user();
        // La relación filtra por usuario y la tabla pivote aporta la cantidad disponible.
        $inventory = $user->tiendaItems()
            ->get([
                'tienda_items.id',
                'tienda_items.nombre_item',
                'tienda_items.descripcion_beneficio',
                'tienda_items.imagen_item',
            ])
            ->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->nombre_item,
                'description' => $item->descripcion_beneficio,
                'image' => $item->imagen_item,
                'quantity' => $item->pivot->cantidad,
            ]);

        // Carga los datos relacionados en una consulta y conserva solo los campos de colección.
        $rewards = $user->recompensasReclamadas()
            ->with('paseTemporada.tiendaItem')
            ->get()
            ->map(fn ($claim) => [
                'id' => $claim->id,
                'claimedAt' => $claim->fecha_reclamo,
                'season' => $claim->paseTemporada?->temporada,
                'name' => $claim->paseTemporada?->tiendaItem?->nombre_item,
                'description' => $claim->paseTemporada?->tiendaItem?->descripcion_beneficio,
            ]);

        return response()->json([
            'inventory' => $inventory,
            'rewards' => $rewards,
        ]);
    }

    // Cierra la sesión y renueva el token CSRF del navegador.
    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }

    // Evita devolver contraseña, token o campos internos al cliente.
    private function userData(Request $request): array
    {
        return $request->user()->only([
            'id',
            'name',
            'email',
            'puntos_totales',
            'estado_usuario',
        ]);
    }
}
