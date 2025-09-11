<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Dependencia;
use App\Models\ProyectoServicioSocial;
use App\Models\ResponsableProyecto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JefeDepartamentoController extends Controller
{
    public function dashboard()
    {
        // Estadísticas generales
        $stats = [
            'total_estudiantes' => Estudiante::count(),
            'estudiantes_activos' => ProyectoServicioSocial::whereIn('estatus', ['Aceptado', 'En Proceso'])->count(),
            'proyectos_pendientes' => ProyectoServicioSocial::where('estatus', 'Registrado')->count(),
            'proyectos_terminados' => ProyectoServicioSocial::where('estatus', 'Terminado')->count(),
            'dependencias_activas' => Dependencia::where('activa', true)->count(),
            'responsables_activos' => ResponsableProyecto::where('activo', true)->count(),
        ];

        // Proyectos por estatus para gráfico
        $proyectos_por_estatus = ProyectoServicioSocial::select('estatus', DB::raw('count(*) as total'))
            ->groupBy('estatus')
            ->pluck('total', 'estatus');

        // Proyectos recientes que requieren atención
        $proyectos_atencion = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->where('estatus', 'Registrado')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Estadísticas por mes para gráfico de tendencias
        $meses = [];
        $proyectos_por_mes = [];
        for ($i = 5; $i >= 0; $i--) {
            $fecha = Carbon::now()->subMonths($i);
            $meses[] = $fecha->format('M Y');
            $proyectos_por_mes[] = ProyectoServicioSocial::whereYear('created_at', $fecha->year)
                ->whereMonth('created_at', $fecha->month)
                ->count();
        }

        // Dependencias más activas
        $dependencias_activas = Dependencia::withCount('proyectosServicioSocial')
            ->orderBy('proyectos_servicio_social_count', 'desc')
            ->take(5)
            ->get();

        return view('jefe.dashboard', compact(
            'stats',
            'proyectos_por_estatus',
            'proyectos_atencion',
            'meses',
            'proyectos_por_mes',
            'dependencias_activas'
        ));
    }

    public function usuarios()
    {
        $usuarios = User::with(['estudiante', 'dependencia', 'responsableProyecto'])
            ->when(request('role'), function($query) {
                $query->where('role', request('role'));
            })
            ->when(request('activo'), function($query) {
                $query->where('activo', request('activo') === '1');
            })
            ->when(request('search'), function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%')
                      ->orWhere('numero_control', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('jefe.usuarios.index', compact('usuarios'));
    }

    public function crearUsuario()
    {
        $dependencias = Dependencia::where('activa', true)->get();
        $estudiantes = Estudiante::whereDoesntHave('user')->get();
        
        return view('jefe.usuarios.crear', compact('dependencias', 'estudiantes'));
    }

    public function almacenarUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:jefe_departamento,responsable_proyecto,estudiante',
            'numero_control' => 'nullable|string|max:20',
            'estudiante_id' => 'nullable|exists:estudiantes,id',
            'dependencia_id' => 'nullable|exists:dependencias,id',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'numero_control' => $request->numero_control,
            'estudiante_id' => $request->estudiante_id,
            'dependencia_id' => $request->dependencia_id,
            'activo' => true,
        ]);

        // Si es responsable de proyecto, crear registro adicional
        if ($request->role === 'responsable_proyecto' && $request->dependencia_id) {
            ResponsableProyecto::create([
                'user_id' => $usuario->id,
                'dependencia_id' => $request->dependencia_id,
                'nombre_completo' => $request->name,
                'cargo' => $request->cargo ?? 'Responsable de Proyecto',
                'telefono' => $request->telefono,
                'email_institucional' => $request->email,
                'activo' => true,
            ]);
        }

        return redirect()->route('jefe.usuarios')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function activarDesactivarUsuario(User $user)
    {
        $user->update(['activo' => !$user->activo]);
        
        $status = $user->activo ? 'activado' : 'desactivado';
        return response()->json([
            'success' => true,
            'message' => "Usuario {$status} exitosamente.",
            'activo' => $user->activo
        ]);
    }

    public function proyectos()
    {
        $proyectos = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->when(request('estatus'), function($query) {
                $query->where('estatus', request('estatus'));
            })
            ->when(request('dependencia'), function($query) {
                $query->where('dependencia_id', request('dependencia'));
            })
            ->when(request('search'), function($query) {
                $query->whereHas('estudiante', function($q) {
                    $q->where('nombres', 'like', '%' . request('search') . '%')
                      ->orWhere('numero_control', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $dependencias = Dependencia::where('activa', true)->get();
        
        return view('jefe.proyectos.index', compact('proyectos', 'dependencias'));
    }

    public function dependencias()
    {
        $dependencias = Dependencia::withCount('proyectosServicioSocial')
            ->when(request('activa'), function($query) {
                $query->where('activa', request('activa') === '1');
            })
            ->when(request('search'), function($query) {
                $query->where('nombre', 'like', '%' . request('search') . '%')
                      ->orWhere('titular', 'like', '%' . request('search') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('jefe.dependencias.index', compact('dependencias'));
    }

    public function coordinacion()
    {
        // Proyectos que requieren coordinación
        $proyectos_pendientes = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->where('estatus', 'Registrado')
            ->orderBy('created_at', 'asc')
            ->get();

        $proyectos_proceso = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->where('estatus', 'En Proceso')
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        // Estudiantes próximos a terminar
        $estudiantes_proximos = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->where('estatus', 'En Proceso')
            ->where('horas_acumuladas', '>=', DB::raw('horas_totales * 0.8'))
            ->orderBy('horas_acumuladas', 'desc')
            ->get();

        return view('jefe.coordinacion.index', compact(
            'proyectos_pendientes',
            'proyectos_proceso',
            'estudiantes_proximos'
        ));
    }

    public function reportes()
    {
        // Estadísticas por período
        $stats_periodo = [
            'mes_actual' => ProyectoServicioSocial::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'trimestre_actual' => ProyectoServicioSocial::whereBetween('created_at', [
                Carbon::now()->startOfQuarter(),
                Carbon::now()->endOfQuarter()
            ])->count(),
            'año_actual' => ProyectoServicioSocial::whereYear('created_at', Carbon::now()->year)->count(),
        ];

        // Reportes por carrera
        $por_carrera = Estudiante::select('carrera', DB::raw('count(*) as total'))
            ->whereHas('proyectosServicioSocial')
            ->groupBy('carrera')
            ->orderBy('total', 'desc')
            ->get();

        // Tiempo promedio de servicio
        $tiempo_promedio = ProyectoServicioSocial::where('estatus', 'Terminado')
            ->whereNotNull('fecha_inicio')
            ->whereNotNull('fecha_terminacion')
            ->selectRaw('AVG(DATEDIFF(fecha_terminacion, fecha_inicio)) as promedio_dias')
            ->first();

        return view('jefe.reportes.index', compact(
            'stats_periodo',
            'por_carrera',
            'tiempo_promedio'
        ));
    }

    // Funciones cuando actúa como jefe de laboratorio
    public function supervisarEstudiantesComoLab()
    {
        $estudiantes = ProyectoServicioSocial::with(['estudiante', 'dependencia'])
            ->whereIn('estatus', ['Aceptado', 'En Proceso'])
            ->when(request('search'), function($query) {
                $query->whereHas('estudiante', function($q) {
                    $q->where('nombres', 'like', '%' . request('search') . '%')
                      ->orWhere('numero_control', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(15);

        return view('jefe.laboratorio.estudiantes', compact('estudiantes'));
    }

    public function aprobarProyectoComoLab(ProyectoServicioSocial $proyecto)
    {
        $proyecto->update([
            'estatus' => 'Aceptado',
            'fecha_carta_aceptacion' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Proyecto aprobado exitosamente como Jefe de Laboratorio.'
        ]);
    }

    public function finalizarProyectoComoLab(ProyectoServicioSocial $proyecto)
    {
        $proyecto->update([
            'estatus' => 'Terminado',
            'fecha_carta_terminacion' => Carbon::now(),
            'horas_acumuladas' => $proyecto->horas_totales
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Proyecto finalizado exitosamente.'
        ]);
    }

    public function configuracion()
    {
        return view('jefe.configuracion.index');
    }
}