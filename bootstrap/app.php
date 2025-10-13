<?php

use Fruitcake\Cors\HandleCors;
use Illuminate\Foundation\Application;
use App\Http\Middleware\PemilikKomentar;
use App\Http\Middleware\PemilikPostingan;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
        $middleware->alias([
            'PemilikPostingan' => PemilikPostingan::class,
            'PemilikKomentar' => PemilikKomentar::class,
            
        ]);
    })


    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
