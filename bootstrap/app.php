<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'menu.access' => \App\Http\Middleware\CheckMenuAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );

        $exceptions->reportable(function (\Throwable $e) {
            // Jangan log error 404 (Not Found) atau 403 (Forbidden) karena ini bukan masalah server/aplikasi
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException || 
                $e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException ||
                $e instanceof \Illuminate\Auth\AuthenticationException) {
                return;
            }

            \App\Models\LErrorApplication::logException($e);
        });
    })->create();
