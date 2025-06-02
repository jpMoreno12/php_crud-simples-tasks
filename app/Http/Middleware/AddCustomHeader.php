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
        // Antes de passar para o próximo
        logger('Passou pelo middleware AddCustomHeader na rota: ' . $request->path());

        // Deixa seguir para o próximo middleware ou controller
        $response = $next($request);

        // Aqui você pode modificar a resposta antes de devolver
        $response->headers->set('X-Custom-Header', 'MiddlewarePassed');

        return $response;
    }
   
}
