<?php

use App\Http\Controllers\CategoriaGlobalController;
use App\Http\Controllers\CategoriaTiendaController;
use App\Http\Controllers\ContenidoEducativoController;
use App\Http\Controllers\EstadoArboleController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HistorialChatController;
use App\Http\Controllers\InventarioUsuarioController;
use App\Http\Controllers\MaterialPorPuntoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PaseTemporadaController;
use App\Http\Controllers\PerfileController;
use App\Http\Controllers\ProgresoPaseController;
use App\Http\Controllers\PuntoRecolecioneController;
use App\Http\Controllers\RankingSemanaleController;
use App\Http\Controllers\RecompensaReclamadaController;
use App\Http\Controllers\RegistroReciclajeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TiendaItemController;
use App\Http\Controllers\TipoMaterialeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// RUTA TIPO-MATERIAL
Route::apiResource('tipos-materiales', TipoMaterialeController::class);
// RUTA CATEGORIA-GLOBAL
Route::apiResource('categorias-globales', CategoriaGlobalController::class);
// RUTA CATEGORIA-TIENDA
Route::apiResource('categorias-tienda', CategoriaTiendaController::class);
// RUTA ZONA
Route::apiResource('zonas', ZonaController::class);
// RUTA ROLES
Route::apiResource('roles', RoleController::class);
// RUTA CATEGORIA-EDUCATIVO
Route::apiResource('contenidos', ContenidoEducativoController::class);
// RUTA ESTADO-ARBOLES
Route::apiResource('arboles', EstadoArboleController::class);
// RUTA DE FEEDBACK
Route::apiResource('reseñas', FeedbackController::class);
// RUTA HISTORIA-CHATS
Route::apiResource('chats', HistorialChatController::class);
// RUTA INVENTARIO-USURAIO TABLA PIVOTE
Route::apiResource('inventarios', InventarioUsuarioController::class);
// RUTA MATERIAL-POR-PUNTOS TABLA PIVOTE
Route::apiResource('materiales', MaterialPorPuntoController::class);
// RUTA NOTICIAS
Route::apiResource('noticias', NoticiaController::class);
// RUTA PASE-TEMPORADA
Route::apiResource('pases', PaseTemporadaController::class);
// RUTA PERFILES
Route::apiResource('perfiles', PerfileController::class);
// RUTA PASE-PROGRESO
Route::apiResource('progresos', ProgresoPaseController::class);
// RUTA PUNTO-RECOLECION
Route::apiResource('puntos', PuntoRecolecioneController::class);
// RUTA RANKING-SEMANAL
Route::apiResource('rankings', RankingSemanaleController::class);
// RUTA RECOMPENSA-RECLAMADA
Route::apiResource('recompensas', RecompensaReclamadaController::class);
// RUTA REGISTRO-RECICLAJE
Route::apiResource('registros', RegistroReciclajeController::class);
// RUTA TIENDA-ITEM
Route::apiResource('items', TiendaItemController::class);
// RUTA USUARIO
Route::apiResource('usuarios', UserController::class);
