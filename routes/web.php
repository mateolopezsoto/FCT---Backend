<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\InstalacionController;
use App\Http\Controllers\Api\TipoInstalacionController;
use App\Http\Controllers\Api\ReservaController;

Route::prefix('api')
    ->withoutMiddleware(['web']) // desactiva todo el middleware web, incluido CSRF
    ->group(function () {

        // Rutas públicas
        Route::post('/login', [UsuarioController::class, 'login']);
        Route::post('/register', [UsuarioController::class, 'register']);

        // Rutas protegidas con Sanctum
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/user', [UsuarioController::class, 'user']);
            Route::post('/logout', [UsuarioController::class, 'logout']);
            Route::get('/instalacions', [InstalacionController::class, 'index']);
            Route::get('/tipos-instalacion', [TipoInstalacionController::class, 'index']);
            Route::post('/reservas', [ReservaController::class, 'store']);
            Route::get('/mis-reservas', [ReservaController::class, 'misReservas']);
        });
});

