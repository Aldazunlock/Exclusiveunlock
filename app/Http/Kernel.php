<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware globales (para todas las peticiones HTTP).
     */
    protected $middleware = [

        \Illuminate\Http\Middleware\HandleCors::class,

        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware groups (agrupados por tipo de petición).
     */
    protected $middlewareGroups = [
        'web' => [
            // ... otros middlewares
            \App\Http\Middleware\CheckActiveUser::class,
        ],

        'filament' => [
            // ... otros middlewares
            \App\Http\Middleware\CheckActiveUser::class,
        ],
    ];

    /**
     * Middleware de rutas individuales.
     */
    protected $routeMiddleware = [
        // ...
        'active' => \App\Http\Middleware\ActiveUserMiddleware::class,
    ];
}