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
        // Trust proxies for Railway deployment - trust all proxies from all hosts
        $middleware->trustProxies(at: '*', headers: \Illuminate\Http\Middleware\TrustProxies::HEADERS_X_FORWARDED_FOR |
            \Illuminate\Http\Middleware\TrustProxies::HEADERS_X_FORWARDED_HOST |
            \Illuminate\Http\Middleware\TrustProxies::HEADERS_X_FORWARDED_PROTO);
        
        // Add our custom HTTPS enforcement middleware to run after other middleware
        $middleware->append(\App\Http\Middleware\ForceHttps::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
