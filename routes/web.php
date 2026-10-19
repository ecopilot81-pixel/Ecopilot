<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\WebAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/consultas', [ConsultasController::class, 'ver']);

// Entrega a React un token CSRF asociado a la sesión del navegador.
Route::get('/csrf-token', fn () => response()->json(['csrf_token' => csrf_token()]));

// Maneja el inicio de sesión, la consulta del usuario y el cierre de sesión con cookies web.
Route::post('/login', [WebAuthController::class, 'login'])->middleware('throttle:10,1');
Route::get('/me', [WebAuthController::class, 'currentUser'])->middleware('auth');
// Protege los datos personales y filtra el perfil según la sesión activa.
Route::get('/my-profile', [WebAuthController::class, 'currentProfile'])->middleware('auth');
// Entrega únicamente la colección asociada al usuario autenticado.
Route::get('/my-collection', [WebAuthController::class, 'currentCollection'])->middleware('auth');
Route::post('/logout', [WebAuthController::class, 'logout'])->middleware('auth');
