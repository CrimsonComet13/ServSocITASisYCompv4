@extends('layouts.app')

@section('title', 'Dashboard - Jefe de Departamento')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <p class="text-gray-400">Panel de control - Jefe de Departamento</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm font-medium">
                Sistema Activo
            </span>
            <span class="text-sm text-gray-400">
                {{ now()->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Estudiantes -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Estudiantes</h3>
                    <p class="text-3xl font-bold text-blue-400 mt-2">245</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-green-400">+12</span> este mes
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Proyectos Activos -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Proyectos Activos</h3>
                    <p class="text-3xl font-bold text-green-400 mt-2">89</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-green-400">+7</span> esta semana
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Dependencias -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Dependencias</h3>
                    <p class="text-3xl font-bold text-purple-400 mt-2">34</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-blue-400">2</span> nuevas
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completados -->
        <div class="glass-dark rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Completados</h3>
                    <p class="text-3xl font-bold text-yellow-400 mt-2">156</p>
                    <p class="text-sm text-gray-400 mt-1">
                        <span class="text-green-400">94%</span> éxito
                    </p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Section -->
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Estadísticas Mensuales</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-lg text-sm font-medium">6M</button>
                    <button class="px-3 py-1 bg-gray-700 text-gray-400 rounded-lg text-sm font-medium">1A</button>
                </div>
            </div>
            
            <!-- Simple Chart Placeholder -->
            <div class="h-64 flex items-end justify-between space-x-2">
                <div class="bg-blue-500 rounded-t-lg" style="height: 60%; width: 12%;"></div>
                <div class="bg-blue-500 rounded-t-lg" style="height: 80%; width: 12%;"></div>
                <div class="bg-blue-500 rounded-t-lg" style="height: 45%; width: 12%;"></div>
                <div class="bg-blue-500 rounded-t-lg" style="height: 90%; width: 12%;"></div>
                <div class="bg-blue-500 rounded-t-lg" style="height: 75%; width: 12%;"></div>
                <div class="bg-blue-500 rounded-t-lg" style="height: 55%; width: 12%;"></div>
                <div class="bg-blue-500 rounded-t-lg" style="height: 85%; width: 12%;"></div>
            </div>
            
            <div class="flex justify-between text-xs text-gray-400 mt-4">
                <span>Ene</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Abr</span>
                <span>May</span>
                <span>Jun</span>
                <span>Jul</span>
            </div>
        </div>

        <!-- Recent Activity -->
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
                        <p class="text-white text-sm">Proyecto completado</p>
                        <p class="text-gray-400 text-xs">Juan Pérez - Desarrollo Web</p>
                    </div>
                    <span class="text-xs text-gray-400">2h</span>
                </div>

                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Nuevo estudiante registrado</p>
                        <p class="text-gray-400 text-xs">María González - Ing. Sistemas</p>
                    </div>
                    <span class="text-xs text-gray-400">4h</span>
                </div>

                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Reporte bimestral entregado</p>
                        <p class="text-gray-400 text-xs">Carlos Ruiz - 2do Bimestre</p>
                    </div>
                    <span class="text-xs text-gray-400">6h</span>
                </div>

                <!-- Activity Item -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-white text-sm">Nueva dependencia agregada</p>
                        <p class="text-gray-400 text-xs">Secretaría de Salud</p>
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
            <a href="{{ route('jefe.usuarios.crear') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Crear Usuario</h4>
                    <p class="text-gray-400 text-sm">Nuevo estudiante o responsable</p>
                </div>
            </a>

            <!-- Quick Action Card -->
            <a href="{{ route('jefe.dependencias.create') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Nueva Dependencia</h4>
                    <p class="text-gray-400 text-sm">Registrar nueva institución</p>
                </div>
            </a>

            <!-- Quick Action Card -->
            <a href="{{ route('jefe.reportes') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Ver Reportes</h4>
                    <p class="text-gray-400 text-sm">Análisis y estadísticas</p>
                </div>
            </a>

            <!-- Quick Action Card -->
            <a href="{{ route('jefe.configuracion') }}" 
               class="flex items-center space-x-4 p-4 glass rounded-xl hover:bg-white/10 transition-all duration-200 card-hover">
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-medium">Configuración</h4>
                    <p class="text-gray-400 text-sm">Ajustes del sistema</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Projects Overview -->
    <div class="glass-dark rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-white">Proyectos por Estado</h3>
            <a href="{{ route('jefe.proyectos') }}" 
               class="text-blue-400 hover:text-blue-300 text-sm font-medium">Ver todos</a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Status Card -->
            <div class="text-center p-4 glass rounded-xl">
                <div class="w-8 h-8 bg-blue-500/20 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                </div>
                <p class="text-2xl font-bold text-white">23</p>
                <p class="text-sm text-gray-400">Registrados</p>
            </div>

            <!-- Status Card -->
            <div class="text-center p-4 glass rounded-xl">
                <div class="w-8 h-8 bg-green-500/20 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                </div>
                <p class="text-2xl font-bold text-white">45</p>
                <p class="text-sm text-gray-400">Aceptados</p>
            </div>

            <!-- Status Card -->
            <div class="text-center p-4 glass rounded-xl">
                <div class="w-8 h-8 bg-yellow-500/20 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                </div>
                <p class="text-2xl font-bold text-white">89</p>
                <p class="text-sm text-gray-400">En Proceso</p>
            </div>

            <!-- Status Card -->
            <div class="text-center p-4 glass rounded-xl">
                <div class="w-8 h-8 bg-purple-500/20 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                </div>
                <p class="text-2xl font-bold text-white">156</p>
                <p class="text-sm text-gray-400">Terminados</p>
            </div>

            <!-- Status Card -->
            <div class="text-center p-4 glass rounded-xl">
                <div class="w-8 h-8 bg-red-500/20 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                </div>
                <p class="text-2xl font-bold text-white">12</p>
                <p class="text-sm text-gray-400">Cancelados</p>
            </div>
        </div>
    </div>
</div>
@endsection