<?php

namespace App\Http\Controllers;

use App\Models\ProyectoServicioSocial;
use App\Models\ReporteBimestral;
use App\Models\ReporteFinal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ResponsableProyectoController extends Controller
{
    public function dashboard()
    {
        /** @var \App\Models\ResponsableProyecto $responsable */
        $responsable = Auth::user()->responsableProyecto;
        
        $stats = [
            'proyectos_asignados'   => $responsable->proyectosSupervisa()->count(),
            'proyectos_en_proceso'  => $responsable->proyectosSupervisa()->where('estatus', 'En Proceso')->count(),
            'proyectos_terminados'  => $responsable->proyectosSupervisa()->where('estatus', 'Terminado')->count(),
            'reportes_pendientes'   => 0, // Se implementará con reportes bimestrales
        ];

        $proyectosAsignados = $responsable->proyectosSupervisa()
            ->with(['estudiante'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $proximosVencer = $responsable->proyectosSupervisa()
            ->with(['estudiante'])
            ->where('estatus', 'En Proceso')
            ->where('fecha_terminacion', '<=', Carbon::now()->addDays(30))
            ->orderBy('fecha_terminacion')
            ->get();

        return view('responsable.dashboard', compact('stats', 'proyectosAsignados', 'proximosVencer'));
    }

    public function misProyectos()
    {
        /** @var \App\Models\ResponsableProyecto $responsable */
        $responsable = Auth::user()->responsableProyecto;
        
        $proyectos = $responsable->proyectosSupervisa()
            ->with(['estudiante'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('responsable.proyectos.index', compact('proyectos'));
    }

    public function verProyecto(ProyectoServicioSocial $proyecto)
    {
        if (!Auth::user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para ver este proyecto.');
        }

        $proyecto->load(['estudiante', 'dependencia']);

        return view('responsable.proyectos.show', compact('proyecto'));
    }

    public function evaluarProyecto(ProyectoServicioSocial $proyecto)
    {
        if (!Auth::user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para evaluar este proyecto.');
        }

        $proyecto->load(['estudiante']);

        return view('responsable.proyectos.evaluar', compact('proyecto'));
    }

    public function guardarEvaluacion(Request $request, ProyectoServicioSocial $proyecto)
    {
        if (!Auth::user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para evaluar este proyecto.');
        }

        $validated = $request->validate([
            'evaluacion' => 'required|array',
            'evaluacion.*.criterio' => 'required|string',
            'evaluacion.*.calificacion' => 'required|integer|min:0|max:4',
            'observaciones' => 'nullable|string',
            'estatus' => 'required|in:Aceptado,En Proceso,Terminado',
        ]);

        $proyecto->update([
            'estatus' => $validated['estatus']
        ]);

        return redirect()->route('responsable.proyectos.show', $proyecto)
            ->with('success', 'Evaluación guardada exitosamente.');
    }

    public function reportesBimestrales()
    {
        /** @var \App\Models\ResponsableProyecto $responsable */
        $responsable = Auth::user()->responsableProyecto;
        
        $reportes = collect(); // Placeholder

        return view('responsable.reportes.bimestrales', compact('reportes'));
    }

    public function reportesFinales()
    {
        /** @var \App\Models\ResponsableProyecto $responsable */
        $responsable = Auth::user()->responsableProyecto;
        
        $reportes = collect(); // Placeholder

        return view('responsable.reportes.finales', compact('reportes'));
    }

    public function cambiarEstatusProyecto(Request $request, ProyectoServicioSocial $proyecto)
    {
        if (!Auth::user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para cambiar el estatus de este proyecto.');
        }

        $validated = $request->validate([
            'estatus' => 'required|in:Aceptado,En Proceso,Terminado,Cancelado',
            'observaciones' => 'nullable|string'
        ]);

        $estatusAnterior = $proyecto->estatus;
        
        if ($validated['estatus'] === 'Aceptado' && !$proyecto->fecha_carta_aceptacion) {
            $proyecto->fecha_carta_aceptacion = Carbon::now()->toDateString();
        }

        if ($validated['estatus'] === 'Terminado') {
            if (!$proyecto->fecha_carta_terminacion) {
                $proyecto->fecha_carta_terminacion = Carbon::now()->toDateString();
            }
            if ($proyecto->horas_acumuladas < $proyecto->horas_totales) {
                $proyecto->horas_acumuladas = $proyecto->horas_totales;
            }
        }

        $proyecto->estatus = $validated['estatus'];
        $proyecto->save();

        return redirect()->route('responsable.proyectos.show', $proyecto)
            ->with('success', "Estatus del proyecto cambiado de '{$estatusAnterior}' a '{$validated['estatus']}' exitosamente.");
    }

    public function perfil()
    {
        /** @var \App\Models\ResponsableProyecto $responsable */
        $responsable = Auth::user()->responsableProyecto;
        
        return view('responsable.perfil', compact('responsable'));
    }

    public function actualizarPerfil(Request $request)
    {
        /** @var \App\Models\ResponsableProyecto $responsable */
        $responsable = Auth::user()->responsableProyecto;
        
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email_institucional' => 'nullable|email|max:255',
        ]);

        $responsable->update($validated);

        return back()->with('success', 'Perfil actualizado exitosamente.');
    }
}
