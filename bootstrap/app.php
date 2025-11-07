<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // ... (Bagian atas file bootstrap/app.php) ...
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // INI YANG HARUS DITAMBAHKAN:
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\CheckIsAdmin::class,
        ]);
        
        // Mungkin sudah ada bawaan Breeze, biarkan saja
        // $middleware->web(append: [ ... ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // ...
    })->create();
