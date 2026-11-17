<?php

namespace App\Http\Controllers;

use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RuntimeException;

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
                'telefono',
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

    // Guarda los datos y la foto del perfil de la cuenta autenticada.
    public function updateCurrentProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $profile = $user->perfil;

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'apellido' => ['required', 'string', 'max:50'],
            'alias' => [
                'required',
                'string',
                'max:50',
                Rule::unique('perfiles', 'alias')->ignore($profile?->id),
            ],
            'telefono' => ['nullable', 'string', 'max:20'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'biografia' => ['nullable', 'string', 'max:255'],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $imagenNueva = $validated['foto_perfil'] ?? null;
        unset($validated['foto_perfil']);

        if (!$profile) {
            $profile = $user->perfil()->make();
        }

        $imagenAnterior = $profile->foto_perfil;
        $profile->fill($validated);

        if ($imagenNueva) {
            try {
                // La foto se carga desde el backend para mantener privadas las credenciales.
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('services.cloudinary.cloud_name'),
                        'api_key' => config('services.cloudinary.api_key'),
                        'api_secret' => config('services.cloudinary.api_secret'),
                    ],
                    'url' => ['secure' => true],
                ]);

                $resultado = $cloudinary->uploadApi()->upload(
                    $imagenNueva->getRealPath(),
                    [
                        // Separa las fotos de perfil de las imágenes de noticias.
                        'folder' => 'perfiles',
                        'resource_type' => 'image',
                    ]
                );
                // El perfil conserva la URL segura en su campo foto_perfil existente.
                $profile->foto_perfil = $resultado['secure_url'];
            } catch (ApiError|RuntimeException $exception) {
                Log::error('No se pudo cargar la foto de perfil en Cloudinary.', [
                    'exception_class' => $exception::class,
                ]);

                return response()->json([
                    'message' => 'No se pudo cargar la foto en Cloudinary.',
                ], 502);
            }
        }

        $profile->user()->associate($user);
        $profile->save();

        // Solo limpia el archivo anterior si pertenecía al almacenamiento local legado.
        if (
            $imagenNueva
            && str_starts_with($imagenAnterior ?? '', 'perfiles/')
        ) {
            Storage::disk('public')->delete($imagenAnterior);
        }

        return $this->currentProfile($request);
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
