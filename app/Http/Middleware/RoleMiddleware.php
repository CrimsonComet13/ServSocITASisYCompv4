<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Actualizar último acceso
        $user->updateLastAccess();

        // Verificar si el usuario está activo
        if (!$user->activo) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Su cuenta ha sido desactivada. Contacte al administrador.');
        }

        // Verificar roles
        if (!$user->hasAnyRole($roles)) {
            abort(403, 'No tiene permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}