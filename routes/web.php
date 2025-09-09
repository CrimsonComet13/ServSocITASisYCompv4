<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\ProyectoServicioSocialController;
use App\Http\Controllers\DocumentoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta de bienvenida - Dashboard principal
Route::get('/', [ProyectoServicioSocialController::class, 'dashboard'])
    ->name('dashboard');

Route::get('/dashboard', [ProyectoServicioSocialController::class, 'dashboard'])
    ->name('dashboard');

// Rutas de recursos principales
Route::resource('estudiantes', EstudianteController::class);
Route::resource('dependencias', DependenciaController::class);
Route::resource('proyectos', ProyectoServicioSocialController::class);

// Rutas adicionales para estudiantes
Route::get('/estudiantes/search/ajax', [EstudianteController::class, 'search'])
    ->name('estudiantes.search');

// Rutas adicionales para dependencias
Route::get('/dependencias/activas/json', [DependenciaController::class, 'activas'])
    ->name('dependencias.activas');

// Rutas adicionales para proyectos
Route::patch('/proyectos/{proyecto}/estatus', [ProyectoServicioSocialController::class, 'cambiarEstatus'])
    ->name('proyectos.cambiar-estatus');

// Rutas para documentos PDF
Route::prefix('documentos')->name('documentos.')->group(function () {
    // Generar PDFs
    Route::get('/proyecto/{proyecto}/carta-aceptacion', [DocumentoController::class, 'cartaAceptacion'])
        ->name('carta-aceptacion');
    
    Route::get('/proyecto/{proyecto}/carta-terminacion', [DocumentoController::class, 'cartaTerminacion'])
        ->name('carta-terminacion');
    
    Route::get('/proyecto/{proyecto}/solicitud-servicio', [DocumentoController::class, 'solicitudServicio'])
        ->name('solicitud-servicio');
    
    // Vistas previas
    Route::get('/proyecto/{proyecto}/preview/{tipo}', [DocumentoController::class, 'preview'])
        ->name('preview')
        ->where('tipo', 'aceptacion|terminacion|solicitud');
});

// Rutas API para funcionalidades AJAX
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/estudiantes/search', [EstudianteController::class, 'search'])
        ->name('estudiantes.search');
    
    Route::get('/dependencias/activas', [DependenciaController::class, 'activas'])
        ->name('dependencias.activas');
});

/*
|--------------------------------------------------------------------------
| Rutas que requerirán autenticación (se implementarán en Etapa 3)
|--------------------------------------------------------------------------
*/

// Estas rutas se protegerán con middleware auth en la siguiente etapa