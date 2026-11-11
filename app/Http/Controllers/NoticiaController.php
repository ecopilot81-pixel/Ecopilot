<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class NoticiaController extends Controller
{
    // METODO MOSTAR TODO LOS DATOS
    public function index()
    {

        $noticias = Noticia::all();

        return response()->json($noticias, 200);
    }

    // CREAR UN REGISTRO
    public function store(Request $request)
    {

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'resumen' => 'required|string',
            'contenido' => 'required|string',
            'imagen_destacada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'fuente' => 'nullable|string|max:255',
            'url_fuente' => 'nullable|string|url|max:255',
            'estado_noticia' => 'nullable|string|max:50',
            'categoria_global_id' => 'required|exists:categoria_globals,id',
        ]);

        if ($request->hasFile('imagen_destacada')) {
            try {
                // Usa las credenciales del servidor para no exponer el secreto de Cloudinary al cliente.
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('services.cloudinary.cloud_name'),
                        'api_key' => config('services.cloudinary.api_key'),
                        'api_secret' => config('services.cloudinary.api_secret'),
                    ],
                    'url' => ['secure' => true],
                ]);

                $resultado = $cloudinary->uploadApi()->upload(
                    $request->file('imagen_destacada')->getRealPath(),
                    [
                        // Mantiene las imágenes de noticias agrupadas en Cloudinary.
                        'folder' => 'noticias',
                        'resource_type' => 'image',
                    ]
                );
                // La columna existente guarda la URL pública segura, no el archivo local.
                $validated['imagen_destacada'] = $resultado['secure_url'];
            } catch (ApiError|RuntimeException $exception) {
                Log::error('No se pudo cargar la imagen de noticia en Cloudinary.', [
                    'exception_class' => $exception::class,
                ]);

                return response()->json(['message' => 'No se pudo cargar la imagen en Cloudinary.'], 502);
            }
        }

        $validated['user_id'] = $request->user()->id;
        $noticia = Noticia::create($validated);

        return response()->json($noticia, 201);
    }

    // MOSTRAR UN SOLO REGISTRO
    public function show($id)
    {

        $noticia = Noticia::findOrFail($id);

        return response()->json($noticia, 200);
    }

    // ACTUALIZAR REGISTRO
    public function update(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'resumen' => 'required|string',
            'contenido' => 'required|string',
            'imagen_destacada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'fuente' => 'nullable|string|max:255',
            'url_fuente' => 'nullable|string|url|max:255',
            'estado_noticia' => 'nullable|string|max:50',
            'categoria_global_id' => 'required|exists:categoria_globals,id',
        ]);

        $imagenAnterior = $noticia->imagen_destacada;
        if ($request->hasFile('imagen_destacada')) {
            try {
                // Sube la nueva imagen antes de guardar sus datos en la noticia.
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('services.cloudinary.cloud_name'),
                        'api_key' => config('services.cloudinary.api_key'),
                        'api_secret' => config('services.cloudinary.api_secret'),
                    ],
                    'url' => ['secure' => true],
                ]);

                $resultado = $cloudinary->uploadApi()->upload(
                    $request->file('imagen_destacada')->getRealPath(),
                    [
                        // Usa la misma carpeta que la creación de noticias.
                        'folder' => 'noticias',
                        'resource_type' => 'image',
                    ]
                );
                // Reemplaza la URL almacenada solo cuando se envió una imagen nueva.
                $validated['imagen_destacada'] = $resultado['secure_url'];
            } catch (ApiError|RuntimeException $exception) {
                Log::error('No se pudo reemplazar la imagen de noticia en Cloudinary.', [
                    'exception_class' => $exception::class,
                ]);

                return response()->json(['message' => 'No se pudo cargar la imagen en Cloudinary.'], 502);
            }
        }

        $noticia->update($validated);

        // Conserva compatibilidad con imágenes locales anteriores; las URLs de Cloudinary no son rutas locales.
        if ($request->hasFile('imagen_destacada') && str_starts_with($imagenAnterior ?? '', 'noticias/')) {
            Storage::disk('public')->delete($imagenAnterior);
        }

        return response()->json($noticia, 200);
    }

    // ELIMINIAR UN REGISTRO
    public function destroy($id)
    {

        $noticia = Noticia::findOrFail($id);
        $imagen = $noticia->imagen_destacada;
        $noticia->delete();

        if (str_starts_with($imagen ?? '', 'noticias/')) {
            Storage::disk('public')->delete($imagen);
        }

        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
