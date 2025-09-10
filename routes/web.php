<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\ProyectoServicioSocialController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\JefeDepartamentoController;
use App\Http\Controllers\ResponsableProyectoController;
use App\Http\Controllers\EstudianteDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Dashboard principal - redirige según el rol
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    
    if ($user->isJefeDepartamento()) {
        return redirect()->route('jefe.dashboard');
    } elseif ($user->isResponsableProyecto()) {
        return redirect()->route('responsable.dashboard');
    } elseif ($user->isEstudiante()) {
        return redirect()->route('estudiante.dashboard');
    }
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas para Jefe de Departamento
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'jefe.departamento'])->prefix('jefe')->name('jefe.')->group(function () {
    Route::get('/dashboard', [JefeDepartamentoController::class, 'dashboard'])->name('dashboard');
    
    // Gestión de usuarios
    Route::get('/usuarios', [JefeDepartamentoController::class, 'usuarios'])->name('usuarios');
    Route::get('/usuarios/crear', [JefeDepartamentoController::class, 'crearUsuario'])->name('usuarios.crear');
    Route::post('/usuarios', [JefeDepartamentoController::class, 'almacenarUsuario'])->name('usuarios.store');
    Route::patch('/usuarios/{user}/toggle-status', [JefeDepartamentoController::class, 'activarDesactivarUsuario'])->name('usuarios.toggle-status');
    
    // Reportes y estadísticas
    Route::get('/reportes', [JefeDepartamentoController::class, 'reportes'])->name('reportes');
    Route::get('/proyectos', [JefeDepartamentoController::class, 'proyectos'])->name('proyectos');
    Route::get('/dependencias', [JefeDepartamentoController::class, 'dependencias'])->name('dependencias');
    
    // Configuración
    Route::get('/configuracion', [JefeDepartamentoController::class, 'configuracion'])->name('configuracion');
    
    // Acceso completo a recursos principales
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('dependencias', DependenciaController::class);
    Route::resource('proyectos-completos', ProyectoServicioSocialController::class);
});

/*
|--------------------------------------------------------------------------
| Rutas para Responsable de Proyecto
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'responsable.proyecto'])->prefix('responsable')->name('responsable.')->group(function () {
    Route::get('/dashboard', [ResponsableProyectoController::class, 'dashboard'])->name('dashboard');
    
    // Proyectos asignados
    Route::get('/proyectos', [ResponsableProyectoController::class, 'misProyectos'])->name('proyectos.index');
    Route::get('/proyectos/{proyecto}', [ResponsableProyectoController::class, 'verProyecto'])->name('proyectos.show');
    Route::get('/proyectos/{proyecto}/evaluar', [ResponsableProyectoController::class, 'evaluarProyecto'])->name('proyectos.evaluar');
    Route::post('/proyectos/{proyecto}/evaluacion', [ResponsableProyectoController::class, 'guardarEvaluacion'])->name('proyectos.guardar-evaluacion');
    Route::patch('/proyectos/{proyecto}/estatus', [ResponsableProyectoController::class, 'cambiarEstatusProyecto'])->name('proyectos.cambiar-estatus');
    
    // Reportes
    Route::get('/reportes/bimestrales', [ResponsableProyectoController::class, 'reportesBimestrales'])->name('reportes.bimestrales');
    Route::get('/reportes/finales', [ResponsableProyectoController::class, 'reportesFinales'])->name('reportes.finales');
    
    // Perfil
    Route::get('/perfil', [ResponsableProyectoController::class, 'perfil'])->name('perfil');
    Route::patch('/perfil', [ResponsableProyectoController::class, 'actualizarPerfil'])->name('perfil.update');
});

/*
|--------------------------------------------------------------------------
| Rutas para Estudiante
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'estudiante'])->prefix('estudiante')->name('estudiante.')->group(function () {
    Route::get('/dashboard', [EstudianteDashboardController::class, 'dashboard'])->name('dashboard');
    
    // Proyecto de servicio social
    Route::get('/mi-proyecto', [EstudianteDashboardController::class, 'miProyecto'])->name('mi-proyecto');
    Route::get('/solicitar-proyecto', [EstudianteDashboardController::class, 'solicitudProyecto'])->name('solicitar-proyecto');
    Route::post('/solicitar-proyecto', [EstudianteDashboardController::class, 'enviarSolicitud'])->name('enviar-solicitud');
    Route::post('/cancelar-proyecto', [EstudianteDashboardController::class, 'cancelarProyecto'])->name('cancelar-proyecto');
    
    // Documentos
    Route::get('/documentos', [EstudianteDashboardController::class, 'documentos'])->name('documentos');
    
    // Reportes
    Route::get('/reportes', [EstudianteDashboardController::class, 'reportes'])->name('reportes');
    
    // Historial
    Route::get('/historial', [EstudianteDashboardController::class, 'historial'])->name('historial');
    
    // Perfil
    Route::get('/perfil', [EstudianteDashboardController::class, 'perfil'])->name('perfil');
    Route::patch('/perfil', [EstudianteDashboardController::class, 'actualizarPerfil'])->name('perfil.update');
});

/*
|--------------------------------------------------------------------------
| Rutas para documentos PDF (accesibles por múltiples roles)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:jefe_departamento,responsable_proyecto,estudiante'])->prefix('documentos')->name('documentos.')->group(function () {
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

/*
|--------------------------------------------------------------------------
| Rutas API para funcionalidades AJAX
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('api')->name('api.')->group(function () {
    Route::get('/estudiantes/search', [EstudianteController::class, 'search'])
        ->name('estudiantes.search');
    
    Route::get('/dependencias/activas', [DependenciaController::class, 'activas'])
        ->name('dependencias.activas');
});

/*
|--------------------------------------------------------------------------
| Rutas de perfil de usuario (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';