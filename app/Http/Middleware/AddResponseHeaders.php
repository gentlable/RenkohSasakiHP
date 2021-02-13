<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;

use Closure;

class AddResponseHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof Response) {
            // $response->header('Cache-control', 'no-store');
            // $response->header('Pragma', 'no-cache');
            $response->header('X-Frame-Options', 'Deny');
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('X-XSS-Protection', '1; mode=block');

            // $response->header('Access-Control-Allow-Origin', '*');
        }

        return $response;
    }
}
