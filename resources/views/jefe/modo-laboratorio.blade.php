@extends('layouts.app')

@section('title', 'Modo Laboratorio - Jefe de Departamento')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <div class="flex items-center space-x-3">
                <h1 class="text-3xl font-bold text-white">Modo Laboratorio</h1>
                <span class="px-3 py-1 bg-orange-500/20 text-orange-400 rounded-full text-sm font-medium">
                    Jefe Supervisando
                </span>
            </div>
            <p class="text-gray-400">Funciones de laboratorio asumidas por el Jefe de Departamento</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('jefe.dashboard') }}" 
               class="px-4 py-2 glass border border-gray-600 text-white rounded-xl font-medium hover:bg-white/10 transition-colors">
                Volver al Dashboard
            </a>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="bg-blue-500/10 border border-blue-500/20 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-blue-400 font-medium mb-2">Modo Laboratorio Activado</h3>
                <p class="text-gray-300 text-sm">Como Jefe de Departamento, tienes acceso completo a todas las funciones de laboratorio y supervisión de proyectos. Esta vista te permite actuar con los mismos permisos que un Jefe de Laboratorio cuando sea necesario.</p>
            </div>
        </div>
    </div>

    <!-- Quick Laboratory Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Proyectos Pendientes de Supervisión -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-xs font-medium">
                    Supervisión Directa
                </span>
            </div>
            <h4 class="text-lg font-semibold text-white mb-2">Proyectos Pendientes</h4>
            <p class="text-gray-400 text-sm mb-4">Proyectos que requieren supervisión o aprobación directa del jefe</p>
            <div class="space-y-2">
                <div class="text-2xl font-bold text-yellow-400">12</div>
                <div class="text-sm text-gray-400">Requieren atención</div>
                <button class="w-full px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-xl font-medium transition-colors">
                    Revisar Proyectos
                </button>
            </div>
        </div>

        <!-- Evaluaciones de Laboratorio -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <span class="px-2 py-1 bg-purple-500/20 text-purple-400 rounded-full text-xs font-medium">
                    Evaluación
                </span>
            </div>
            <h4 class="text-lg font-semibold text-white mb-2">Evaluaciones Pendientes</h4>
            <p class="text-gray-400 text-sm mb-4">Reportes bimestrales y evaluaciones que requieren tu revisión</p>
            <div class="space-y-2">
                <div class="text-2xl font-bold text-purple-400">8</div>
                <div class="text-sm text-gray-400">Reportes por evaluar</div>
                <button class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-medium transition-colors">
                    Evaluar Reportes
                </button>
            </div>
        </div>

        <!-- Supervisión de Laboratorios -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-medium">
                    Activo
                </span>
            </div>
            <h4 class="text-lg font-semibold text-white mb-2">Laboratorios Activos</h4>
            <p class="text-gray-400 text-sm mb-4">Laboratorios con proyectos de servicio social en curso</p>
            <div class="space-y-2">
                <div class="text-2xl font-bold text-green-400">5</div>
                <div class="text-sm text-gray-400">Laboratorios supervisados</div>
                <button class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors">
                    Ver Laboratorios
                </button>
            </div>
        </div>
    </div>

    <!-- Laboratory Functions Panel -->
    <div class="glass-dark rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Funciones de Laboratorio Disponibles</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <h4 class="text-lg font-medium text-white">Supervisión Directa</h4>
                
                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-4 glass rounded-xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-white">Asignar Proyectos Críticos</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 glass rounded-xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-white">Resolver Conflictos de Proyecto</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 glass rounded-xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-white">Aprobar Finalizaciones</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-4">
                <h4 class="text-lg font-medium text-white">Gestión Operativa</h4>
                
                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-4 glass rounded-xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="text-white">Evaluar Reportes Bimestrales</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 glass rounded-xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-teal-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <span class="text-white">Supervisar Estudiantes</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 glass rounded-xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                                </svg>
                            </div>
                            <span class="text-white">Generar Reportes de Lab</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Laboratory Activities -->
    <div class="glass-dark rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Actividades Recientes de Laboratorio</h3>
        
        <div class="space-y-4">
            <div class="flex items-center space-x-4 p-4 glass rounded-xl">
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-white font-medium">Proyecto asignado directamente</p>
                    <p class="text-gray-400 text-sm">Laboratorio de Redes - Estudiante: María González</p>
                </div>
                <span class="text-xs text-gray-400">Hace 2h</span>
            </div>
            
            <div class="flex items-center space-x-4 p-4 glass rounded-xl">
                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-white font-medium">Reporte bimestral aprobado</p>
                    <p class="text-gray-400 text-sm">Lab. Desarrollo Web - Estudiante: Carlos Ruiz</p>
                </div>
                <span class="text-xs text-gray-400">Hace 4h</span>
            </div>
            
            <div class="flex items-center space-x-4 p-4 glass rounded-xl">
                <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-white font-medium">Conflicto resuelto</p>
                    <p class="text-gray-400 text-sm">Lab. Base de Datos - Problema de horarios solucionado</p>
                </div>
                <span class="text-xs text-gray-400">Hace 1d</span>
            </div>
        </div>
    </div>

    <!-- Switch Back Notice -->
    <div class="bg-orange-500/10 border border-orange-500/20 rounded-2xl p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-orange-500/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-orange-400 font-medium mb-2">Funciones Temporales</h3>
                    <p class="text-gray-300 text-sm">Estás operando en modo laboratorio con permisos elevados. Recuerda que estas funciones son complementarias a tus responsabilidades principales como Jefe de Departamento.</p>
                </div>
            </div>
            <a href="{{ route('jefe.dashboard') }}" 
               class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-xl font-medium transition-colors">
                Finalizar Modo Lab
            </a>
        </div>
    </div>
</div>
@endsection