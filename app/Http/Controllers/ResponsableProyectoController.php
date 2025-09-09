<?php

namespace App\Http\Controllers;

use App\Models\ProyectoServicioSocial;
use App\Models\ReporteBimestral;
use App\Models\ReporteFinal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResponsableProyectoController extends Controller
{
    public function dashboard()
    {
        $responsable = auth()->user()->responsableProyecto;
        
        $stats = [
            'proyectos_asignados' => $responsable->proyectosSupervisa()->count(),
            'proyectos_en_proceso' => $responsable->proyectosSupervisa()->where('estatus', 'En Proceso')->count(),
            'proyectos_terminados' => $responsable->proyectosSupervisa()->where('estatus', 'Terminado')->count(),
            'reportes_pendientes' => 0, // Se implementará con reportes bimestrales
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
        $responsable = auth()->user()->responsableProyecto;
        
        $proyectos = $responsable->proyectosSupervisa()
            ->with(['estudiante'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('responsable.proyectos.index', compact('proyectos'));
    }

    public function verProyecto(ProyectoServicioSocial $proyecto)
    {
        // Verificar que este responsable pueda ver este proyecto
        if (!auth()->user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para ver este proyecto.');
        }

        $proyecto->load(['estudiante', 'dependencia']);

        return view('responsable.proyectos.show', compact('proyecto'));
    }

    public function evaluarProyecto(ProyectoServicioSocial $proyecto)
    {
        // Verificar permisos
        if (!auth()->user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para evaluar este proyecto.');
        }

        $proyecto->load(['estudiante']);

        return view('responsable.proyectos.evaluar', compact('proyecto'));
    }

    public function guardarEvaluacion(Request $request, ProyectoServicioSocial $proyecto)
    {
        // Verificar permisos
        if (!auth()->user()->responsableProyecto->canEvaluateProject($proyecto)) {
            abort(403, 'No tiene permisos para evaluar este proyecto.');
        }

        $validated = $request->validate([
            'evaluacion' => 'required|array',
            'evaluacion.*.criterio' => 'required|string',
            'evaluacion.*.calificacion' => 'required|integer|min:0|max:4',
            'observaciones' => 'nullable|string',
            'estatus' => 'required|in:Aceptado,En Proceso,Terminado',
        ]);

        // Aquí se guardaría la evaluación en la tabla correspondiente
        // Por ahora actualizamos el estatus del proyecto

        $proyecto->update([
            'estatus' => $validated['estatus']
        ]);

        return redirect()->route('responsable.proyectos.show', $proyecto)
            ->with('success', 'Evaluación guardada exitosamente.');
    }

    public function reportesBimestrales()
    {
        $responsable = auth()->user()->responsableProyecto;
        
        // Esta funcionalidad se implementará cuando creemos las migraciones de reportes
        $reportes = collect(); // Placeholder

        return view('responsable.reportes.bimestrales', compact('reportes'));
    }

    public function reportesFinales()
    {
        $responsable = auth()->user()->responsableProyecto;
        
        // Esta funcionalidad se implementará cuando creemos las migraciones de reportes
        $reportes