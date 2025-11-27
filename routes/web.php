<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes – Laravel 12 style
|--------------------------------------------------------------------------
*/

Route::prefix('api')->group(function () {

    // Rutas públicas (sin autenticación)
    Route::post('/login', [UsuarioController::class, 'login']);
    Route::post('/register', [UsuarioController::class, 'register']);

    // Ruta para obtener el token CSRF (Sanctum)
    Route::get('/sanctum/csrf-cookie', function () {
        return response()->json(['message' => 'CSRF cookie set']);
    });

    // Rutas protegidas con Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [UsuarioController::class, 'user']);
        Route::post('/logout', [UsuarioController::class, 'logout']);
    });
});