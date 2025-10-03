<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
<<<<<<< HEAD
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
=======
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
>>>>>>> 48e710125124d44c28cebfa1ff3e710a51d43118
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
