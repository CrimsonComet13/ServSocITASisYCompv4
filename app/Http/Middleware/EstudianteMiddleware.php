<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EstudianteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!$user->isEstudiante()) {
            abort(403, 'Solo los Estudiantes pueden acceder a esta sección.');
        }

        // Verificar que tenga perfil de estudiante vinculado
        if (!$user->estudiante) {
            abort(403, 'Su perfil de estudiante no está correctamente configurado.');
        }

        return $next($request);
    }
}