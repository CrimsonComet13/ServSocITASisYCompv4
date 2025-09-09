<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckServicioSocialAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Por ahora permitimos acceso completo
        // En la Etapa 3 implementaremos la lógica de roles
        return $next($request);
    }
}