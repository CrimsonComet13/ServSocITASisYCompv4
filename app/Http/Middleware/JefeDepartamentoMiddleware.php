<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JefeDepartamentoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isJefeDepartamento()) {
            abort(403, 'Solo el Jefe de Departamento puede acceder a esta sección.');
        }

        return $next($request);
    }
}