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
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append([
        //     ImpersonateMiddleware::class,
        // ]);
        $middleware->alias([
            'locked' => \App\Http\Middleware\LockedMiddleware::class,
            // 'verification' => \App\Http\Middleware\EmailCodeVerification::class,
            // 'suspended' => \App\Http\Middleware\UserSuspendedMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
