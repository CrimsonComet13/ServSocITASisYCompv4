@extends('layouts.app')

@section('title', 'Dashboard - Estudiante')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-white">Mi Dashboard</h1>
            <p class="text-gray-400">Bienvenido, {{ auth()->user()->name }}</p>
        </div>
        <div class="flex items-center space-x-3">
            @if(auth()->user()->estudiante && auth()->user()->estudiante->proyectoActual)
                <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm font-medium">
                    Proyecto Activo
                </span>
            @else
                <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-sm font-medium">
                    Sin Proyecto
                </span>
            @endif
        </div>
    </div>

    <!-- Project Status Card -->
    @if(auth()->user()->estudiante && auth()->user()->estudiante->proyectoActual)
        @php $proyecto = auth()->user()->estudiante->proyectoActual; @endphp
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between space-y-4 lg:space-y-0">
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-white mb-2">Mi Proyecto de Servicio Social</h3>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-6">
                        <div>
                            <p class="text-sm text-gray-400">Programa</p>
                            <p class="text-white font-medium">{{ $proyecto->nombre_programa }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Dependencia</p>
                            <p class="text-white font-medium">{{ $proyecto->dependencia->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Estado</p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @if($proyecto->estatus === 'Registrado') bg-blue-500/20 text-blue-400
                                @elseif($proyecto->estatus === 'Aceptado') bg-green-500/20 text-green-400
                                @elseif($proyecto->estatus === 'En Proceso') bg-yellow-500/20 text-yellow-400
                                @elseif($proyecto->estatus === 'Terminado') bg-purple-500/20 text-purple-400
                                @else bg-red-500/20 text-red-400 @endif">
                                {{ $proyecto->estatus }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('estudiante.mi-proyecto') }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors">
                        Ver Detalles
                    </a>
                    <a href="{{ route('estudiante.documentos') }}" 
                       class="px-4 py-2 glass border border-gray-600 text-white rounded-xl font-medium hover:bg-white/10 transition-colors">
                        Documentos
                    </a>
                </div>
            </div>
        </div>

        <!-- Progress Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Hours Progress -->
            <div class="glass-dark rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold text-white">Progreso de Horas</h4>
                    <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Completadas</span>
                        <span class="text-white font-medium">{{ $proyecto->horas_acumuladas }}/{{ $proyecto->horas_totales }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-3 rounded-full transition-all duration-500"
                             style="width: {{ $proyecto->porcentaje_avance }}%"></div>
                    </div>
                    <p class="text-2xl font-bold text-blue-400">{{ number_format($proyecto->porcentaje_avance, 1) }}%</p>
                </div>
            </div>

            <!-- Time Remaining -->
            <div class="glass-dark rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold text-white">Tiempo Restante</h4>
                    <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    @if($proyecto->dias_restantes > 0)
                        <p class="text-2xl font-bold text-green-400">{{ $proyecto->dias_restantes }}</p>
                        <p class="text-sm text-gray-400">días restantes</p>
                    @elseif($proyecto->dias_restantes === 0)
                        <p class="text-2xl font-bold text-yellow-400">Hoy</p>
                        <p class="text-sm text-gray-400">es el último día</p>
                    @else
                        <p class="text-2xl font-bold text-red-400">{{ abs($proyecto->dias_restantes) }}</p>
                        <p class="text-sm text-gray-400">días de retraso</p>
                    @endif
                    <p class="text-xs text-gray-500">Fecha límite: {{ $proyecto->fecha_terminacion->format('d/m/Y') }}</p>
                </div>
            </div>

            <!-- Next Report -->
            <div class="glass-dark rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold text-white">Próximo Reporte</h4>
                    <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-2xl font-bold text-yellow-400">2do</p>
                    <p class="text-sm text-gray-400">Reporte Bimestral</p>
                    <p class="text-xs text-gray-500">Vence: 15/03/2025</p>
                    <button class="mt-2 px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-lg text-xs font-medium hover:bg-yellow-500/30 transition-colors">
                        Generar PDF
                    </button>
                </div>
            </div>
        </div>
    @else
        <!-- No Project State -->
        <div class="glass-dark rounded-2xl p-8 text-center">
            <div class="w-20 h-20 bg-blue-500/20 rounded-full mx-auto mb-6 flex items-center justify-center">
                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">¡Comienza tu Servicio Social!</h3>
            <p class="text-gray-400 mb-6 max-w-md mx-auto">
                Aún no tienes un proyecto asignado. Solicita uno para comenzar tu servicio social.
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

    <!-- Quick Actions -->
    <div class="glass-dark rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Acciones Rápidas</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Quick Action: My Project -->
            <a href="{{ route('estudiante.mi-proyecto') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Mi Proyecto</h4>
                    <p class="text-gray-400 text-sm">Ver detalles y progreso</p>
                </div>
            </a>

            <!-- Quick Action: Documents -->
            <a href="{{ route('estudiante.documentos') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Documentos</h4>
                    <p class="text-gray-400 text-sm">Descargar formatos PDF</p>
                </div>
            </a>

            <!-- Quick Action: Reports -->
            <a href="{{ route('estudiante.reportes') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Reportes</h4>
                    <p class="text-gray-400 text-sm">Bimestrales y finales</p>
                </div>
            </a>

            <!-- Quick Action: Profile -->
            <a href="{{ route('estudiante.perfil') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Mi Perfil</h4>
                    <p class="text-gray-400 text-sm">Actualizar información</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Activity Timeline -->
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Actividad Reciente</h3>
                <a href="{{ route('estudiante.historial') }}" 
                   class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver historial</a>
            </div>
            
            <div class="space-y-4">
                <!-- Timeline Item -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center mt-1">
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-medium">Proyecto aceptado</p>
                        <p class="text-gray-400 text-xs">Tu solicitud fue aprobada por la dependencia</p>
                        <p class="text-gray-500 text-xs mt-1">Hace 2 días</p>
                    </div>
                </div>

                <!-- Timeline Item -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center mt-1">
                        <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-medium">Solicitud enviada</p>
                        <p class="text-gray-400 text-xs">Solicitud de servicio social registrada</p>
                        <p class="text-gray-500 text-xs mt-1">Hace 1 semana</p>
                    </div>
                </div>

                <!-- Timeline Item -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center mt-1">
                        <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm font-medium">Perfil completado</p>
                        <p class="text-gray-400 text-xs">Información académica actualizada</p>
                        <p class="text-gray-500 text-xs mt-1">Hace 2 semanas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Info -->
        <div class="glass-dark rounded-2xl p-6">
            <h3 class="text-xl font-semibold text-white mb-6">Información Académica</h3>
            
            @if(auth()->user()->estudiante)
                @php $estudiante = auth()->user()->estudiante; @endphp
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-700">
                        <span class="text-gray-400">Número de Control</span>
                        <span class="text-white font-medium">{{ $estudiante->numero_control }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-3 border-b border-gray-700">
                        <span class="text-gray-400">Carrera</span>
                        <span class="text-white font-medium text-right">{{ $estudiante->carrera }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-3 border-b border-gray-700">
                        <span class="text-gray-400">Semestre</span>
                        <span class="text-white font-medium">{{ $estudiante->semestre }}°</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-3 border-b border-gray-700">
                        <span class="text-gray-400">Créditos</span>
                        <span class="text-white font-medium">{{ $estudiante->creditos }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-3">
                        <span class="text-gray-400">Período</span>
                        <span class="text-white font-medium">{{ $estudiante->periodo }}</span>
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-yellow-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.99-.833-2.76 0L4.054 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h4 class="text-white font-medium mb-2">Información Incompleta</h4>
                    <p class="text-gray-400 text-sm mb-4">Completa tu perfil académico para acceder a todas las funciones</p>
                    <a href="{{ route('estudiante.perfil') }}" 
                       class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-xl font-medium transition-colors">
                        Completar Perfil
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Notifications or Alerts -->
    <div class="glass-dark rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Notificaciones y Recordatorios</h3>
        
        <div class="space-y-4">
            <!-- Alert Item -->
            <div class="flex items-center space-x-4 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-blue-400 font-medium">Reporte Bimestral Próximo</h4>
                    <p class="text-gray-300 text-sm">Tu segundo reporte bimestral vence el 15 de marzo</p>
                </div>
                <button class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Ver
                </button>
            </div>

            <!-- Alert Item -->
            <div class="flex items-center space-x-4 p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-green-400 font-medium">Carta de Aceptación Disponible</h4>
                    <p class="text-gray-300 text-sm">Ya puedes descargar tu carta de aceptación oficial</p>
                </div>
                <button class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Descargar
                </button>
            </div>

            <!-- Alert Item -->
            <div class="flex items-center space-x-4 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
                <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-yellow-400 font-medium">Actualizar Información de Contacto</h4>
                    <p class="text-gray-300 text-sm">Revisa y actualiza tu información personal</p>
                </div>
                <button class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection