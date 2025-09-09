<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResponsableProyectoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!$user->isResponsableProyecto()) {
            abort(403, 'Solo los Responsables de Proyecto pueden acceder a esta sección.');
        }

        // Verificar que tenga perfil de responsable activo
        if (!$user->responsableProyecto || !$user->responsableProyecto->activo) {
            abort(403, 'Su perfil de Responsable de Proyecto no está activo.');
        }

        return $next($request);
    }
}