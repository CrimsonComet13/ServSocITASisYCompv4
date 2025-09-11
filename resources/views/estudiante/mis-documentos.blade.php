@extends('layouts.app')

@section('title', 'Mis Documentos')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-white">Mis Documentos</h1>
            <p class="text-gray-400">Descarga tus documentos oficiales de servicio social</p>
        </div>
        <div class="flex items-center space-x-3">
            @if(auth()->user()->estudiante && auth()->user()->estudiante->proyectoActual)
                <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm font-medium">
                    Documentos Disponibles
                </span>
            @else
                <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-sm font-medium">
                    Sin Proyecto Activo
                </span>
            @endif
        </div>
    </div>

    @if(auth()->user()->estudiante && auth()->user()->estudiante->proyectoActual)
        @php $proyecto = auth()->user()->estudiante->proyectoActual; @endphp
        
        <!-- Project Info Card -->
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex flex-col lg:flex-row items-start lg:items-center space-y-4 lg:space-y-0 lg:space-x-6">
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-white mb-2">{{ $proyecto->nombre_programa }}</h3>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <div>
                            <span class="text-gray-400">Dependencia:</span>
                            <span class="text-white ml-1">{{ $proyecto->dependencia->nombre }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Estado:</span>
                            <span class="ml-1 px-2 py-1 rounded-full text-xs font-medium
                                @if($proyecto->estatus === 'Registrado') bg-blue-500/20 text-blue-400
                                @elseif($proyecto->estatus === 'Aceptado') bg-green-500/20 text-green-400
                                @elseif($proyecto->estatus === 'En Proceso') bg-yellow-500/20 text-yellow-400
                                @elseif($proyecto->estatus === 'Terminado') bg-purple-500/20 text-purple-400
                                @else bg-red-500/20 text-red-400 @endif">
                                {{ $proyecto->estatus }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-400">Período:</span>
                            <span class="text-white ml-1">{{ $proyecto->fecha_inicio->format('d/m/Y') }} - {{ $proyecto->fecha_terminacion->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Solicitud de Servicio Social -->
            <div class="glass-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-medium">
                        Disponible
                    </span>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Solicitud de Servicio Social</h4>
                <p class="text-gray-400 text-sm mb-4">Formulario oficial ITA-VI-SS-FO-01 con tus datos académicos</p>
                <div class="space-y-2">
                    <a href="{{ route('pdf.solicitud-servicio-social', $proyecto->id) }}" 
                       target="_blank"
                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descargar PDF
                    </a>
                </div>
            </div>

            <!-- Carta de Aceptación -->
            <div class="glass-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    @if(in_array($proyecto->estatus, ['Aceptado', 'En Proceso', 'Terminado']))
                        <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-medium">
                            Disponible
                        </span>
                    @else
                        <span class="px-2 py-1 bg-gray-500/20 text-gray-400 rounded-full text-xs font-medium">
                            No Disponible
                        </span>
                    @endif
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Carta de Aceptación</h4>
                <p class="text-gray-400 text-sm mb-4">Documento oficial que confirma tu aceptación en el proyecto</p>
                <div class="space-y-2">
                    @if(in_array($proyecto->estatus, ['Aceptado', 'En Proceso', 'Terminado']))
                        <a href="{{ route('pdf.carta-aceptacion', $proyecto->id) }}" 
                           target="_blank"
                           class="w-full flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Descargar PDF
                        </a>
                    @else
                        <button disabled 
                                class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-gray-400 rounded-xl font-medium cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Proyecto Pendiente
                        </button>
                    @endif
                </div>
            </div>

            <!-- Reportes Bimestrales -->
            <div class="glass-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    @if(in_array($proyecto->estatus, ['En Proceso', 'Terminado']))
                        <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-xs font-medium">
                            3 Reportes
                        </span>
                    @else
                        <span class="px-2 py-1 bg-gray-500/20 text-gray-400 rounded-full text-xs font-medium">
                            No Disponible
                        </span>
                    @endif
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Reportes Bimestrales</h4>
                <p class="text-gray-400 text-sm mb-4">Formularios ITA-VI-SS-FO-02 para seguimiento de actividades</p>
                <div class="space-y-2">
                    @if(in_array($proyecto->estatus, ['En Proceso', 'Terminado']))
                        <div class="grid grid-cols-3 gap-2">
                            @for($i = 1; $i <= 3; $i++)
                                <a href="{{ route('pdf.reporte-bimestral', [$proyecto->id, $i]) }}" 
                                   target="_blank"
                                   class="flex items-center justify-center px-2 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium transition-colors">
                                    {{ $i }}º
                                </a>
                            @endfor
                        </div>
                    @else
                        <button disabled 
                                class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-gray-400 rounded-xl font-medium cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Proyecto No Iniciado
                        </button>
                    @endif
                </div>
            </div>

            <!-- Reporte Final -->
            <div class="glass-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    @if($proyecto->estatus === 'Terminado')
                        <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded-full text-xs font-medium">
                            Disponible
                        </span>
                    @else
                        <span class="px-2 py-1 bg-gray-500/20 text-gray-400 rounded-full text-xs font-medium">
                            No Disponible
                        </span>
                    @endif
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Reporte Final</h4>
                <p class="text-gray-400 text-sm mb-4">Formulario ITA-VI-SS-FO-03 con resumen completo de actividades</p>
                <div class="space-y-2">
                    @if($proyecto->estatus === 'Terminado')
                        <a href="{{ route('pdf.reporte-final', $proyecto->id) }}" 
                           target="_blank"
                           class="w-full flex items-center justify-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Descargar PDF
                        </a>
                    @else
                        <button disabled 
                                class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-gray-400 rounded-xl font-medium cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Proyecto No Completado
                        </button>
                    @endif
                </div>
            </div>

            <!-- Carta de Terminación -->
            <div class="glass-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-teal-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    @if($proyecto->estatus === 'Terminado')
                        <span class="px-2 py-1 bg-teal-500/20 text-teal-400 rounded-full text-xs font-medium">
                            Disponible
                        </span>
                    @else
                        <span class="px-2 py-1 bg-gray-500/20 text-gray-400 rounded-full text-xs font-medium">
                            No Disponible
                        </span>
                    @endif
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Carta de Terminación</h4>
                <p class="text-gray-400 text-sm mb-4">Documento oficial que certifica la conclusión del servicio social</p>
                <div class="space-y-2">
                    @if($proyecto->estatus === 'Terminado')
                        <a href="{{ route('pdf.carta-terminacion', $proyecto->id) }}" 
                           target="_blank"
                           class="w-full flex items-center justify-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-xl font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Descargar PDF
                        </a>
                    @else
                        <button disabled 
                                class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-gray-400 rounded-xl font-medium cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Proyecto No Completado
                        </button>
                    @endif
                </div>
            </div>

            <!-- Constancia de Liberación -->
            <div class="glass-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2h2a2 2 0 012 2z"></path>
                        </svg>
                    </div>
                    @if($proyecto->estatus === 'Terminado')
                        <span class="px-2 py-1 bg-indigo-500/20 text-indigo-400 rounded-full text-xs font-medium">
                            Disponible
                        </span>
                    @else
                        <span class="px-2 py-1 bg-gray-500/20 text-gray-400 rounded-full text-xs font-medium">
                            No Disponible
                        </span>
                    @endif
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Constancia de Liberación</h4>
                <p class="text-gray-400 text-sm mb-4">Documento oficial que certifica la liberación del servicio social</p>
                <div class="space-y-2">
                    @if($proyecto->estatus === 'Terminado')
                        <button class="w-full flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Solicitar Constancia
                        </button>
                    @else
                        <button disabled 
                                class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-gray-400 rounded-xl font-medium cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Proyecto No Completado
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="glass-dark rounded-2xl p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Instrucciones para Descargar Documentos</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold mt-1">1</div>
                        <div>
                            <h4 class="text-white font-medium">Verificar Estado del Proyecto</h4>
                            <p class="text-gray-400 text-sm">Los documentos están disponibles según el estado de tu proyecto.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-bold mt-1">2</div>
                        <div>
                            <h4 class="text-white font-medium">Descargar en PDF</h4>
                            <p class="text-gray-400 text-sm">Los documentos se abren en una nueva pestaña en formato PDF.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-white text-sm font-bold mt-1">3</div>
                        <div>
                            <h4 class="text-white font-medium">Guardar o Imprimir</h4>
                            <p class="text-gray-400 text-sm">Guarda los documentos en tu dispositivo o imprímelos según necesites.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-4">
                        <h4 class="text-blue-400 font-medium mb-2">Importante</h4>
                        <p class="text-gray-300 text-sm">Todos los documentos son oficiales y contienen información real de tu servicio social. Úsalos únicamente para fines académicos.</p>
                    </div>
                    <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-xl p-4">
                        <h4 class="text-yellow-400 font-medium mb-2">Soporte</h4>
                        <p class="text-gray-300 text-sm">Si tienes problemas para descargar algún documento, contacta al Departamento de Gestión Tecnológica y Vinculación.</p>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- No Project State -->
        <div class="glass-dark rounded-2xl p-8 text-center">
            <div class="w-20 h-20 bg-gray-500/20 rounded-full mx-auto mb-6 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">Sin Proyecto Activo</h3>
            <p class="text-gray-400 mb-6 max-w-md mx-auto">
                Necesitas tener un proyecto de servicio social registrado para acceder a los documentos oficiales.
            </p>
            <a href="{{ route('estudiante.solicitar-proyecto') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-medium hover:from-blue-600 hover:to-purple-700 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Solicitar Proyecto
            </a>
        </div>
    @endif

    <!-- Document Status Legend -->
    <div class="glass-dark rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-white mb-4">Estado de los Documentos</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 bg-green-400 rounded-full"></div>
                <span class="text-sm text-gray-300">Disponible para descarga</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 bg-gray-400 rounded-full"></div>
                <span class="text-sm text-gray-300">No disponible aún</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 bg-yellow-400 rounded-full"></div>
                <span class="text-sm text-gray-300">Múltiples versiones</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-4 h-4 bg-blue-400 rounded-full"></div>
                <span class="text-sm text-gray-300">Proceso requerido</span>
            </div>
        </div>
    </div>

    <!-- Download History (Optional Enhancement) -->
    @if(auth()->user()->estudiante && auth()->user()->estudiante->proyectoActual)
        <div class="glass-dark rounded-2xl p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Historial de Descargas</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Solicitud de Servicio Social</p>
                            <p class="text-gray-400 text-xs">Última descarga</p>
                        </div>
                    </div>
                    <span class="text-gray-400 text-xs">Hace 2 días</span>
                </div>
                
                <div class="flex items-center justify-between py-2 border-b border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Carta de Aceptación</p>
                            <p class="text-gray-400 text-xs">Última descarga</p>
                        </div>
                    </div>
                    <span class="text-gray-400 text-xs">Hace 1 semana</span>
                </div>
                
                <div class="text-center py-4">
                    <button class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                        Ver historial completo
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
// Script para manejar notificaciones de descarga
document.addEventListener('DOMContentLoaded', function() {
    // Detectar clics en enlaces de descarga
    const downloadLinks = document.querySelectorAll('a[href*="/pdf/"]');
    
    downloadLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Mostrar notificación de descarga
            showDownloadNotification();
        });
    });
    
    function showDownloadNotification() {
        // Crear notificación temporal
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 z-50 glass-dark rounded-xl p-4 text-white shadow-lg';
        notification.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium">Generando PDF...</p>
                    <p class="text-xs text-gray-400">Se abrirá en una nueva pestaña</p>
                </div>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>
@endpush
@endsection