<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //API ROUTING
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api/',

        //WEB ROUTING
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // ...
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\CheckRole::class,
            'isVerified' => \App\Http\Middleware\CheckVerified::class,
            'isCustomer' => \App\Http\Middleware\CheckUserRole::class,
            'loggedIn' => \App\Http\Middleware\CheckAuth::class,
            'redirectDashboard' => \App\Http\Middleware\CheckDashboard::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
