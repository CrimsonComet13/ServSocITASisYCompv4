<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\EstudianteRequest;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::with('proyectoActual')
            ->orderBy('apellido_paterno')
            ->paginate(15);
        
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function show(Estudiante $estudiante)
    {
        $estudiante->load(['proyectosServicioSocial.dependencia']);
        
        return view('estudiantes.show', compact('estudiante'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_control' => 'required|string|max:20|unique:estudiantes',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'nombres' => 'required|string|max:100',
            'sexo' => 'required|in:M,F',
            'telefono' => 'required|string|max:15',
            'correo_electronico' => 'required|email|max:100|unique:estudiantes',
            'domicilio' => 'required|string',
            'carrera' => 'required|string|max:150',
            'periodo' => 'required|string|max:20',
            'semestre' => 'required|integer|min:1|max:12',
            'creditos' => 'required|integer|min:0',
        ]);

        $estudiante = Estudiante::create($validated);

        return redirect()->route('estudiantes.show', $estudiante)
            ->with('success', 'Estudiante registrado exitosamente.');
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(EstudianteRequest $request, Estudiante $estudiante)
    {
        $estudiante->update($request->validated());

        return redirect()->route('estudiantes.show', $estudiante)
            ->with('success', 'Información del estudiante actualizada exitosamente.');
    }

    public function destroy(Estudiante $estudiante)
    {
        // Verificar que no tenga proyectos activos
        if ($estudiante->proyectosServicioSocial()->whereIn('estatus', ['Registrado', 'Aceptado', 'En Proceso'])->exists()) {
            return back()->with('error', 'No se puede eliminar el estudiante porque tiene proyectos de servicio social activos.');
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado exitosamente.');
    }

    // Método para buscar estudiantes por número de control o nombre
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $estudiantes = Estudiante::where('numero_control', 'LIKE', "%{$query}%")
            ->orWhere('nombres', 'LIKE', "%{$query}%")
            ->orWhere('apellido_paterno', 'LIKE', "%{$query}%")
            ->orWhere('apellido_materno', 'LIKE', "%{$query}%")
            ->with('proyectoActual')
            ->limit(10)
            ->get();

        return response()->json($estudiantes);
    }
}