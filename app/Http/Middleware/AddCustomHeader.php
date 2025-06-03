<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCustomHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        logger('Passou pelo middleware AddCustomHeader na rota: ' . $request->path());

        $response = $next($request);

        $response->headers->set('X-Custom-Header', 'MiddlewarePassed');

        return $response;
    }
}
