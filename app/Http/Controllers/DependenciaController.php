<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    public function index()
    {
        $dependencias = Dependencia::activas()
            ->withCount('proyectosServicioSocial')
            ->orderBy('nombre_dependencia')
            ->paginate(15);
        
        return view('dependencias.index', compact('dependencias'));
    }

    public function show(Dependencia $dependencia)
    {
        $dependencia->load(['proyectosServicioSocial.estudiante']);
        
        return view('dependencias.show', compact('dependencia'));
    }

    public function create()
    {
        return view('dependencias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_dependencia' => 'required|string|max:200',
            'domicilio_dependencia' => 'required|string',
            'titular_dependencia' => 'required|string|max:150',
            'cargo_titular' => 'required|string|max:150',
            'responsable_proyecto' => 'required|string|max:150',
            'cargo_responsable' => 'required|string|max:150',
            'municipio' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'activa' => 'boolean',
        ]);

        $dependencia = Dependencia::create($validated);

        return redirect()->route('dependencias.show', $dependencia)
            ->with('success', 'Dependencia registrada exitosamente.');
    }

    public function edit(Dependencia $dependencia)
    {
        return view('dependencias.edit', compact('dependencia'));
    }

    public function update(Request $request, Dependencia $dependencia)
    {
        $validated = $request->validate([
            'nombre_dependencia' => 'required|string|max:200',
            'domicilio_dependencia' => 'required|string',
            'titular_dependencia' => 'required|string|max:150',
            'cargo_titular' => 'required|string|max:150',
            'responsable_proyecto' => 'required|string|max:150',
            'cargo_responsable' => 'required|string|max:150',
            'municipio' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'activa' => 'boolean',
        ]);

        $dependencia->update($validated);

        return redirect()->route('dependencias.show', $dependencia)
            ->with('success', 'Información de la dependencia actualizada exitosamente.');
    }

    public function destroy(Dependencia $dependencia)
    {
        // En lugar de eliminar, desactivamos la dependencia si tiene proyectos
        if ($dependencia->proyectosServicioSocial()->exists()) {
            $dependencia->update(['activa' => false]);
            return redirect()->route('dependencias.index')
                ->with('success', 'Dependencia desactivada exitosamente.');
        }

        $dependencia->delete();

        return redirect()->route('dependencias.index')
            ->with('success', 'Dependencia eliminada exitosamente.');
    }

    // Método para obtener dependencias activas (para select)
    public function activas()
    {
        $dependencias = Dependencia::activas()
            ->orderBy('nombre_dependencia')
            ->get(['id', 'nombre_dependencia']);

        return response()->json($dependencias);
    }
}