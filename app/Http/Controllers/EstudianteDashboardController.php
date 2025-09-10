<?php

namespace App\Http\Controllers;

use App\Models\ProyectoServicioSocial;
use App\Models\Dependencia;
use App\Helpers\ServicioSocialHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteDashboardController extends Controller
{
    public function dashboard()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        
        $proyectoActual = $estudiante->proyectoActual;
        
        $stats = [
            'puede_registrar' => ServicioSocialHelper::puedeRegistrarServicio($estudiante),
            'tiene_proyecto_activo' => $proyectoActual ? true : false,
            'horas_completadas' => $proyectoActual ? $proyectoActual->horas_acumuladas : 0,
            'horas_totales' => $proyectoActual ? $proyectoActual->horas_totales : 500,
            'porcentaje_avance' => $proyectoActual ? $proyectoActual->porcentaje_avance : 0,
        ];

        $historialProyectos = $estudiante->proyectosServicioSocial()
            ->with(['dependencia'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('estudiante.dashboard', compact('estudiante', 'proyectoActual', 'stats', 'historialProyectos'));
    }

    public function miProyecto()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        $proyecto = $estudiante->proyectoActual;

        if (!$proyecto) {
            return redirect()->route('estudiante.solicitar-proyecto')
                ->with('info', 'No tiene un proyecto de servicio social registrado actualmente.');
        }

        $proyecto->load(['dependencia']);

        return view('estudiante.proyecto.show', compact('proyecto'));
    }

    public function solicitudProyecto()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        
        // Verificar si ya tiene un proyecto activo
        if ($estudiante->proyectoActual) {
            return redirect()->route('estudiante.mi-proyecto')
                ->with('error', 'Ya tiene un proyecto de servicio social activo.');
        }

        // Verificar requisitos
        $puedeRegistrar = ServicioSocialHelper::puedeRegistrarServicio($estudiante);
        if (!$puedeRegistrar['puede']) {
            return redirect()->route('estudiante.dashboard')
                ->with('error', $puedeRegistrar['mensaje']);
        }

        $dependencias = Dependencia::activas()->orderBy('nombre')->get();
        $tiposProyecto = ServicioSocialHelper::getTiposProyecto();

        return view('estudiante.proyecto.solicitar', compact('dependencias', 'tiposProyecto'));
    }

    public function enviarSolicitud(Request $request)
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        
        // Verificar que no tenga proyecto activo
        if ($estudiante->proyectoActual) {
            return back()->with('error', 'Ya tiene un proyecto de servicio social activo.');
        }

        $validated = $request->validate([
            'dependencia_id' => 'required|exists:dependencias,id',
            'nombre_programa' => 'required|string|max:200',
            'modalidad' => 'required|in:Externa,Interna',
            'fecha_inicio' => 'required|date|after:today',
            'fecha_terminacion' => 'required|date|after:fecha_inicio',
            'actividades_realizar' => 'required|string',
            'tipo_proyecto' => 'required|string|max:100',
            'horas_totales' => 'required|integer|min:480|max:520', // Entre 480 y 520 horas
        ]);

        $proyecto = ProyectoServicioSocial::create([
            'estudiante_id' => $estudiante->id,
            'dependencia_id' => $validated['dependencia_id'],
            'nombre_programa' => $validated['nombre_programa'],
            'modalidad' => $validated['modalidad'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_terminacion' => $validated['fecha_terminacion'],
            'actividades_realizar' => $validated['actividades_realizar'],
            'tipo_proyecto' => $validated['tipo_proyecto'],
            'horas_totales' => $validated['horas_totales'],
            'numero_oficio' => ServicioSocialHelper::generarNumeroOficio(),
            'estatus' => 'Registrado',
        ]);

        return redirect()->route('estudiante.mi-proyecto')
            ->with('success', 'Solicitud de servicio social enviada exitosamente. Su número de oficio es: ' . $proyecto->numero_oficio);
    }

    public function documentos()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        $proyecto = $estudiante->proyectoActual;

        if (!$proyecto) {
            return redirect()->route('estudiante.dashboard')
                ->with('info', 'No tiene un proyecto de servicio social activo.');
        }

        return view('estudiante.documentos.index', compact('proyecto'));
    }

    public function reportes()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        $proyecto = $estudiante->proyectoActual;

        if (!$proyecto) {
            return redirect()->route('estudiante.dashboard')
                ->with('info', 'No tiene un proyecto de servicio social activo.');
        }

        // Aquí se mostrarían los reportes bimestrales
        // Se implementará en etapas posteriores
        
        return view('estudiante.reportes.index', compact('proyecto'));
    }

    public function perfil()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        
        return view('estudiante.perfil', compact('estudiante'));
    }

    public function actualizarPerfil(Request $request)
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        
        $validated = $request->validate([
            'telefono' => 'required|string|max:15',
            'correo_electronico' => 'required|email|max:100|unique:estudiantes,correo_electronico,' . $estudiante->id,
            'domicilio' => 'required|string',
        ]);

        $estudiante->update($validated);

        // También actualizar el email del usuario si cambió
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($validated['correo_electronico'] !== $user->email) {
            $user->update([
                'email' => $validated['correo_electronico']
            ]);
        }

        return back()->with('success', 'Perfil actualizado exitosamente.');
    }

    public function cancelarProyecto(Request $request)
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        $proyecto = $estudiante->proyectoActual;

        if (!$proyecto) {
            return back()->with('error', 'No tiene un proyecto activo para cancelar.');
        }

        // Solo se puede cancelar si está en ciertos estados
        if (!in_array($proyecto->estatus, ['Registrado', 'Aceptado'])) {
            return back()->with('error', 'No se puede cancelar un proyecto que ya está en proceso o terminado.');
        }

        $validated = $request->validate([
            'motivo_cancelacion' => 'required|string|min:10'
        ]);

        $proyecto->update([
            'estatus' => 'Cancelado',
            'actividades_principales' => 'CANCELADO - Motivo: ' . $validated['motivo_cancelacion']
        ]);

        return redirect()->route('estudiante.dashboard')
            ->with('success', 'Proyecto de servicio social cancelado exitosamente.');
    }

    public function historial()
    {
        /** @var \App\Models\Estudiante $estudiante */
        $estudiante = Auth::user()->estudiante;
        
        $proyectos = $estudiante->proyectosServicioSocial()
            ->with(['dependencia'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('estudiante.historial', compact('proyectos'));
    }
}
