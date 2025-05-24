<?php

use App\Http\Controllers\API\ProductoController;
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

// Aquí agregarás tus rutas API personalizadas
// Versión 1 de la API
Route::prefix('v1')->group(function() {
    // Productos
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::get('/productos/menu/{id}', [ProductoController::class, 'porMenu']);

    // Otras rutas API que necesites...
});

// Ruta de ejemplo protegida con autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});