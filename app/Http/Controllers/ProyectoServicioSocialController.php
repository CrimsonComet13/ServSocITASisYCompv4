<?php

namespace App\Http\Controllers;

use App\Models\ProyectoServicioSocial;
use App\Models\Estudiante;
use App\Models\Dependencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProyectoServicioSocialController extends Controller
{
    public function index()
    {
        $proyectos = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('proyectos.index', compact('proyectos'));
    }

    public function show(ProyectoServicioSocial $proyecto)
    {
        $proyecto->load(['estudiante', 'dependencia']);
        
        return view('proyectos.show', compact('proyecto'));
    }

    public function create()
    {
        $estudiantes = Estudiante::orderBy('apellido_paterno')->get();
        $dependencias = Dependencia::activas()->orderBy('nombre_dependencia')->get();
        
        return view('proyectos.create', compact('estudiantes', 'dependencias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'nombre_programa' => 'required|string|max:200',
            'modalidad' => 'required|in:Externa,Interna',
            'fecha_inicio' => 'required|date',
            'fecha_terminacion' => 'required|date|after:fecha_inicio',
            'actividades_realizar' => 'required|string',
            'tipo_proyecto' => 'required|string|max:100',
            'horas_totales' => 'required|integer|min:1',
            'numero_oficio' => 'nullable|string|max:50',
        ]);

        // Verificar que el estudiante no tenga otro proyecto activo
        $estudiante = Estudiante::find($validated['estudiante_id']);
        if ($estudiante->proyectoActual) {
            return back()->with('error', 'El estudiante ya tiene un proyecto de servicio social activo.')
                        ->withInput();
        }

        $proyecto = ProyectoServicioSocial::create($validated);

        return redirect()->route('proyectos.show', $proyecto)
            ->with('success', 'Proyecto de servicio social registrado exitosamente.');
    }

    public function edit(ProyectoServicioSocial $proyecto)
    {
        $estudiantes = Estudiante::orderBy('apellido_paterno')->get();
        $dependencias = Dependencia::activas()->orderBy('nombre_dependencia')->get();
        
        return view('proyectos.edit', compact('proyecto', 'estudiantes', 'dependencias'));
    }

    public function update(Request $request, ProyectoServicioSocial $proyecto)
    {
        $validated = $request->validate([
            'dependencia_id' => 'required|exists:dependencias,id',
            'nombre_programa' => 'required|string|max:200',
            'modalidad' => 'required|in:Externa,Interna',
            'fecha_inicio' => 'required|date',
            'fecha_terminacion' => 'required|date|after:fecha_inicio',
            'actividades_realizar' => 'required|string',
            'tipo_proyecto' => 'required|string|max:100',
            'estatus' => 'required|in:Registrado,Aceptado,En Proceso,Terminado,Cancelado',
            'horas_totales' => 'required|integer|min:1',
            'horas_acumuladas' => 'required|integer|min:0|lte:horas_totales',
            'numero_oficio' => 'nullable|string|max:50',
            'actividades_principales' => 'nullable|string',
        ]);

        $proyecto->update($validated);

        return redirect()->route('proyectos.show', $proyecto)
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy(ProyectoServicioSocial $proyecto)
    {
        // Solo se puede eliminar si está en estado "Registrado"
        if ($proyecto->estatus !== 'Registrado') {
            return back()->with('error', 'Solo se pueden eliminar proyectos que estén en estado "Registrado".');
        }

        $proyecto->delete();

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }

    // Cambiar estatus del proyecto
    public function cambiarEstatus(Request $request, ProyectoServicioSocial $proyecto)
    {
        $validated = $request->validate([
            'estatus' => 'required|in:Registrado,Aceptado,En Proceso,Terminado,Cancelado',
            'observaciones' => 'nullable|string',
        ]);

        $estatusAnterior = $proyecto->estatus;
        $proyecto->estatus = $validated['estatus'];

        // Lógica especial para ciertos cambios de estatus
        if ($validated['estatus'] === 'Aceptado' && !$proyecto->fecha_carta_aceptacion) {
            $proyecto->fecha_carta_aceptacion = Carbon::now()->toDateString();
        }

        if ($validated['estatus'] === 'Terminado' && !$proyecto->fecha_carta_terminacion) {
            $proyecto->fecha_carta_terminacion = Carbon::now()->toDateString();
            // Asegurar que las horas estén completas
            if ($proyecto->horas_acumuladas < $proyecto->horas_totales) {
                $proyecto->horas_acumuladas = $proyecto->horas_totales;
            }
        }

        $proyecto->save();

        return redirect()->route('proyectos.show', $proyecto)
            ->with('success', "Estatus cambiado de '{$estatusAnterior}' a '{$validated['estatus']}' exitosamente.");
    }

    // Dashboard con estadísticas
    public function dashboard()
    {
        $stats = [
            'total' => ProyectoServicioSocial::count(),
            'en_proceso' => ProyectoServicioSocial::where('estatus', 'En Proceso')->count(),
            'terminados' => ProyectoServicioSocial::where('estatus', 'Terminado')->count(),
            'cancelados' => ProyectoServicioSocial::where('estatus', 'Cancelado')->count(),
        ];

        $proyectosRecientes = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $proyectosPorVencer = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->where('estatus', 'En Proceso')
            ->where('fecha_terminacion', '<=', Carbon::now()->addDays(30))
            ->orderBy('fecha_terminacion')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'proyectosRecientes', 'proyectosPorVencer'));
    }
}