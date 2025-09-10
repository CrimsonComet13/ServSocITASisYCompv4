<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    public function index()
    {
        $dependencias = Dependencia::orderBy('nombre')  // CORREGIDO: era 'nombre_dependencia'
            ->paginate(10);
        
        return view('dependencias.index', compact('dependencias'));
    }

    public function create()
    {
        return view('dependencias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',  // CORREGIDO: era 'nombre_dependencia'
            'domicilio' => 'required|string',
            'titular' => 'required|string|max:150',
            'cargo_titular' => 'required|string|max:100',
            'responsable' => 'nullable|string|max:150',
            'cargo_responsable' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'municipio' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'activa' => 'boolean'
        ]);

        $dependencia = Dependencia::create($validated);

        return redirect()->route('dependencias.index')
            ->with('success', 'Dependencia creada exitosamente.');
    }

    public function show(Dependencia $dependencia)
    {
        $proyectos = $dependencia->proyectosServicioSocial()
            ->with('estudiante')
            ->paginate(10);
            
        return view('dependencias.show', compact('dependencia', 'proyectos'));
    }

    public function edit(Dependencia $dependencia)
    {
        return view('dependencias.edit', compact('dependencia'));
    }

    public function update(Request $request, Dependencia $dependencia)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',  // CORREGIDO: era 'nombre_dependencia'
            'domicilio' => 'required|string',
            'titular' => 'required|string|max:150',
            'cargo_titular' => 'required|string|max:100',
            'responsable' => 'nullable|string|max:150',
            'cargo_responsable' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'municipio' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'activa' => 'boolean'
        ]);

        $dependencia->update($validated);

        return redirect()->route('dependencias.index')
            ->with('success', 'Dependencia actualizada exitosamente.');
    }

    public function destroy(Dependencia $dependencia)
    {
        if ($dependencia->proyectosServicioSocial()->exists()) {
            return redirect()->route('dependencias.index')
                ->with('error', 'No se puede eliminar la dependencia porque tiene proyectos asociados.');
        }

        $dependencia->delete();

        return redirect()->route('dependencias.index')
            ->with('success', 'Dependencia eliminada exitosamente.');
    }

    // API method para búsquedas AJAX
    public function activas()
    {
        $dependencias = Dependencia::activas()
            ->orderBy('nombre')  // CORREGIDO: era 'nombre_dependencia'
            ->get(['id', 'nombre']);  // CORREGIDO: era 'nombre_dependencia'
            
        return response()->json($dependencias);
    }
}