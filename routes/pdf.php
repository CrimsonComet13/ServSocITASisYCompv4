<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PDF Routes
|--------------------------------------------------------------------------
|
| Rutas para generar documentos PDF del sistema de servicio social
|
*/

Route::middleware(['auth'])->group(function () {
    
    // Carta de Aceptación - Accesible por todos los roles
    Route::get('/pdf/carta-aceptacion/{proyecto}', [PDFController::class, 'cartaAceptacion'])
        ->name('pdf.carta-aceptacion');
    
    // Carta de Terminación - Solo proyectos terminados
    Route::get('/pdf/carta-terminacion/{proyecto}', [PDFController::class, 'cartaTerminacion'])
        ->name('pdf.carta-terminacion');
    
    // Solicitud de Servicio Social - Formulario oficial
    Route::get('/pdf/solicitud-servicio-social/{proyecto}', [PDFController::class, 'solicitudServicioSocial'])
        ->name('pdf.solicitud-servicio-social');
    
    // Reporte Bimestral - Con número de bimestre
    Route::get('/pdf/reporte-bimestral/{proyecto}/{bimestre?}', [PDFController::class, 'reporteBimestral'])
        ->name('pdf.reporte-bimestral')
        ->where('bimestre', '[1-3]'); // Solo bimestres 1, 2, 3
    
    // Reporte Final
    Route::get('/pdf/reporte-final/{proyecto}', [PDFController::class, 'reporteFinal'])
        ->name('pdf.reporte-final');
    
});

// Rutas específicas por rol
Route::middleware(['auth'])->group(function () {
    
    // Jefe de Departamento - Acceso completo a todos los PDFs
    Route::middleware(['role:jefe_departamento'])->prefix('jefe')->group(function () {
        Route::get('/documentos/{proyecto}', function($proyecto) {
            return view('jefe.documentos-proyecto', compact('proyecto'));
        })->name('jefe.documentos-proyecto');
    });
    
    // Responsable de Proyecto - Solo proyectos de su dependencia
    Route::middleware(['role:responsable_proyecto'])->prefix('responsable')->group(function () {
        Route::get('/documentos/{proyecto}', function($proyecto) {
            return view('responsable.documentos-proyecto', compact('proyecto'));
        })->name('responsable.documentos-proyecto');
    });
    
    // Estudiante - Solo sus propios documentos
    Route::middleware(['role:estudiante'])->prefix('estudiante')->group(function () {
        Route::get('/mis-documentos', function() {
            return view('estudiante.mis-documentos');
        })->name('estudiante.mis-documentos');
    });
    
});