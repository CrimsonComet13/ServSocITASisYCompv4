@extends('layouts.app')

@section('title', 'Dashboard - Jefe de Laboratorio')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <p class="text-gray-400">Jefe de Laboratorio / Responsable de Proyecto</p>
        </div>
        <div class="flex items-center space-x-3">
            @if(auth()->user()->dependencia)
                <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm font-medium">
                    {{ auth()->user()->dependencia->nombre }}
                </span>
            @endif
            <span class="text-sm text-gray-400">
                {{ now()->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Mis Proyectos -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Mis Proyectos</h3>
                    <p class="text-3xl font-bold text-blue-400 mt-2">15</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-green-400">+3</span> este mes
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Estudiantes Asignados -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Estudiantes</h3>
                    <p class="text-3xl font-bold text-green-400 mt-2">28</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-blue-400">5</span> por evaluar
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Reportes Pendientes -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Reportes</h3>
                    <p class="text-3xl font-bold text-yellow-400 mt-2">7</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-red-400">3</span> urgentes
                    </p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Laboratorio -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Laboratorio</h3>
                    <p class="text-3xl font-bold text-purple-400 mt-2">85%</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-green-400">Operativo</span>
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Overview and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Mis Proyectos por Estado -->
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Proyectos por Estado</h3>
                <a href="{{ route('responsable.proyectos.index') }}" 
                   class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver todos</a>
            </div>
            
            <div class="space-y-4">
                <!-- Estado Item -->
                <div class="flex items-center justify-between p-3 glass rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                        <span class="text-white font-medium">En Proceso</span>
                    </div>
                    <span class="text-yellow-400 font-bold">8</span>
                </div>

                <!-- Estado Item -->
                <div class="flex items-center justify-between p-3 glass rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                        <span class="text-white font-medium">Aceptados</span>
                    </div>
                    <span class="text-green-400 font-bold">5</span>
                </div>

                <!-- Estado Item -->
                <div class="flex items-center justify-between p-3 glass rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                        <span class="text-white font-medium">Registrados</span>
                    </div>
                    <span class="text-blue-400 font-bold">2</span>
                </div>

                <!-- Estado Item -->
                <div class="flex items-center justify-between p-3 glass rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                        <span class="text-white font-medium">Terminados</span>
                    </div>
                    <span class="text-purple-400 font-bold">12</span>
                </div>
            </div>
        </div>

        <!-- Actividad Reciente -->
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Actividad Reciente</h3>
                <button class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver todo</button>
            </div>
            
            <div class="space-y-4">
                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Reporte bimestral aprobado</p>
                        <p class="text-gray-400 text-xs">Ana María López - Desarrollo Web</p>
                    </div>
                    <span class="text-xs text-gray-400">1h</span>
                </div>

                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Nuevo proyecto asignado</p>
                        <p class="text-gray-400 text-xs">Carlos Mendoza - Base de Datos</p>
                    </div>
                    <span class="text-xs text-gray-400">3h</span>
                </div>

                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Reporte pendiente de revisión</p>
                        <p class="text-gray-400 text-xs">María González - Redes</p>
                    </div>
                    <span class="text-xs text-gray-400">5h</span>
                </div>

                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Proyecto finalizado</p>
                        <p class="text-gray-400 text-xs">Roberto Silva - Sistemas</p>
                    </div>
                    <span class="text-xs text-gray-400">1d</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="glass-dark rounded-2xl p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Acciones Rápidas</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Quick Action Card -->
            <a href="{{ route('responsable.proyectos.index') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Ver Proyectos</h4>
                    <p class="text-gray-400 text-sm">Gestionar mis proyectos</p>
                </div>
            </a>

            <!-- Quick Action Card -->
            <a href="{{ route('responsable.reportes.bimestrales') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Revisar Reportes</h4>
                    <p class="text-gray-400 text-sm">Evaluar bimestrales</p>
                </div>
            </a>

            <!-- Quick Action Card -->
            <a href="{{ route('responsable.laboratorio') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Gestión Lab</h4>
                    <p class="text-gray-400 text-sm">Administrar laboratorio</p>
                </div>
            </a>

            <!-- Quick Action Card -->
            <a href="{{ route('responsable.seguimiento') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Seguimiento</h4>
                    <p class="text-gray-400 text-sm">Monitorear progreso</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Pending Tasks -->
    <div class="glass-dark rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Tareas Pendientes</h3>
            <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded-full text-xs font-medium">
                7 urgentes
            </span>
        </div>
        
        <div class="space-y-3">
            <!-- Task Item -->
            <div class="flex items-center justify-between p-4 glass rounded-xl">
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                    <div>
                        <p class="text-white font-medium">Evaluar reporte bimestral - Ana López</p>
                        <p class="text-gray-400 text-sm">Vence hoy</p>
                    </div>
                </div>
                <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Revisar
                </button>
            </div>

            <!-- Task Item -->
            <div class="flex items-center justify-between p-4 glass rounded-xl">
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                    <div>
                        <p class="text-white font-medium">Asignar proyecto - Carlos Mendoza</p>
                        <p class="text-gray-400 text-sm">Vence mañana</p>
                    </div>
                </div>
                <button class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Asignar
                </button>
            </div>

            <!-- Task Item -->
            <div class="flex items-center justify-between p-4 glass rounded-xl">
                <div class="flex items-center space-x-4">
                    <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                    <div>
                        <p class="text-white font-medium">Revisar equipos de laboratorio</p>
                        <p class="text-gray-400 text-sm">Esta semana</p>
                    </div>
                </div>
                <button class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Inspeccionar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection