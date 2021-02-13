<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class HttpsProtocol
{
    public function handle($request, Closure $next)
    {
        // If it is not APP_URL, redirect to APP_URL
        if ((config('my.force_app_url') == true) &&
            (config('my.https_auto_redirect') == true) &&
            $request->getHttpHost() !== parse_url(config('app.url'), PHP_URL_HOST)
        ) {
            return redirect()->to(config('app.url'));
        }

        // If access is from http, redirect to https
        if ((config('my.https_auto_redirect') == true) &&
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER["HTTP_X_FORWARDED_PROTO"] != 'https' &&
            !$request->secure()
        ) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
