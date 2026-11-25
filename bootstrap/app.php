
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR |
                Request::HEADER_X_FORWARDED_HOST |
                Request::HEADER_X_FORWARDED_PORT |
                Request::HEADER_X_FORWARDED_PROTO
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->report(function (TokenMismatchException $exception) {
            $request = request();

            Log::error('HUSTLEBOARD CSRF SESSION ERROR', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'is_secure' => $request->isSecure(),
                'has_session' => $request->hasSession(),
                'session_id' => $request->hasSession()
                    ? $request->session()->getId()
                    : null,
                'session_driver' => config('session.driver'),
                'cookie_names' => array_keys($request->cookies->all()),
                'referer' => $request->header('referer'),
                'forwarded_proto' => $request->header('x-forwarded-proto'),
            ]);
        });

    })->create();
