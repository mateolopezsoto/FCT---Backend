<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias para usar cors en rutas individuales si quieres
        $middleware->alias([
            'cors' => \Illuminate\Http\Middleware\HandleCors::class,
        ]);

        // 1. CORS en todas las rutas API (necesario)
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class
        ]);

        // 2. ESTO ES LO QUE FALTABA: Sanctum en TODAS las peticiones (web + api)
        $middleware->append([
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        // Opcional: también puedes ponerlo solo en web si prefieres
        // $middleware->web(append: [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();