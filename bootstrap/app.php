<?php

use Illuminate\Foundation\Application;
<<<<<<< HEAD
=======
use App\Http\Middleware\RoleMiddleware;
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
<<<<<<< HEAD
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
=======
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
