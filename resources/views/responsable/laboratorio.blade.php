@extends('layouts.app')
@section('title', 'Gestión de Laboratorios')
@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-white">Gestión de Laboratorios</h1>
            <p class="text-gray-400">Administración y supervisión de espacios de trabajo</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="abrirModalNuevoLaboratorio()" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Nuevo Laboratorio</span>
            </button>
        </div>
    </div>

    <!-- Laboratory Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Total Labs</h3>
                    <p class="text-3xl font-bold text-blue-400 mt-2">4</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Operativos</h3>
                    <p class="text-3xl font-bold text-green-400 mt-2">4</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>

        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Estudiantes</h3>
                    <p class="text-3xl font-bold text-purple-400 mt-2">23</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="glass-dark rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">Ocupación</h3>
                    <p class="text-3xl font-bold text-yellow-400 mt-2">76%</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="glass-dark rounded-xl p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" 
                       placeholder="Buscar laboratorio..." 
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <select class="px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos los estados</option>
                <option value="operativo">Operativo</option>
                <option value="mantenimiento">En mantenimiento</option>
                <option value="fuera_servicio">Fuera de servicio</option>
            </select>
            <select class="px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las capacidades</option>
                <option value="alto">Alta capacidad (>20)</option>
                <option value="medio">Media capacidad (10-20)</option>
                <option value="bajo">Baja capacidad (<10)</option>
            </select>
        </div>
    </div>

    <!-- Lista de Laboratorios -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Laboratorio de Sistemas -->
        <div class="glass-dark rounded-xl p-6 card-hover">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Lab. Sistemas y Computación</h3>
                        <p class="text-gray-400 text-sm">Edificio A - Planta 2</p>
                    </div>
                </div>
                <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-lg text-sm font-medium">
                    Operativo
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Capacidad</p>
                    <p class="text-white font-semibold">25 estaciones</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Ocupación actual</p>
                    <p class="text-white font-semibold">18 estudiantes</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Responsable</p>
                    <p class="text-white font-semibold">Dr. García López</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Horario</p>
                    <p class="text-white font-semibold">7:00 - 21:00</p>
                </div>
            </div>

            <!-- Barra de ocupación -->
            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-400 mb-2">
                    <span>Ocupación</span>
                    <span>72% (18/25)</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 72%"></div>
                </div>
            </div>

            <!-- Equipos principales -->
            <div class="mb-4">
                <h4 class="text-white font-medium mb-2">Equipos principales</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">25 Computadoras</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">2 Proyectores</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Red Gigabit</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Aire Acondicionado</span>
                </div>
            </div>

            <div class="flex space-x-2">
                <button onclick="verDetallesLab('sistemas')" 
                        class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors text-sm">
                    Ver Detalles
                </button>
                <button onclick="gestionarLab('sistemas')" 
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Laboratorio de Redes -->
        <div class="glass-dark rounded-xl p-6 card-hover">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Lab. Redes y Telecomunicaciones</h3>
                        <p class="text-gray-400 text-sm">Edificio A - Planta 3</p>
                    </div>
                </div>
                <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-lg text-sm font-medium">
                    Operativo
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Capacidad</p>
                    <p class="text-white font-semibold">15 estaciones</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Ocupación actual</p>
                    <p class="text-white font-semibold">3 estudiantes</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Responsable</p>
                    <p class="text-white font-semibold">Ing. Martínez Cruz</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Horario</p>
                    <p class="text-white font-semibold">8:00 - 18:00</p>
                </div>
            </div>

            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-400 mb-2">
                    <span>Ocupación</span>
                    <span>20% (3/15)</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 20%"></div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="text-white font-medium mb-2">Equipos principales</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Cisco Routers</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Switches L3</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Analizador de Red</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Fibra Óptica</span>
                </div>
            </div>

            <div class="flex space-x-2">
                <button onclick="verDetallesLab('redes')" 
                        class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors text-sm">
                    Ver Detalles
                </button>
                <button onclick="gestionarLab('redes')" 
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Laboratorio de Software -->
        <div class="glass-dark rounded-xl p-6 card-hover">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Lab. Desarrollo de Software</h3>
                        <p class="text-gray-400 text-sm">Edificio B - Planta 1</p>
                    </div>
                </div>
                <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-lg text-sm font-medium">
                    Operativo
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Capacidad</p>
                    <p class="text-white font-semibold">20 estaciones</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Ocupación actual</p>
                    <p class="text-white font-semibold">2 estudiantes</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Responsable</p>
                    <p class="text-white font-semibold">M.C. Rodríguez Silva</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Horario</p>
                    <p class="text-white font-semibold">9:00 - 20:00</p>
                </div>
            </div>

            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-400 mb-2">
                    <span>Ocupación</span>
                    <span>10% (2/20)</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: 10%"></div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="text-white font-medium mb-2">Equipos principales</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Workstations Intel i7</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">IDEs Múltiples</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Servidores de Prueba</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Git Server</span>
                </div>
            </div>

            <div class="flex space-x-2">
                <button onclick="verDetallesLab('software')" 
                        class="flex-1 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors text-sm">
                    Ver Detalles
                </button>
                <button onclick="gestionarLab('software')" 
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Laboratorio de Hardware -->
        <div class="glass-dark rounded-xl p-6 card-hover">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Lab. Hardware y Mantenimiento</h3>
                        <p class="text-gray-400 text-sm">Edificio C - Planta 1</p>
                    </div>
                </div>
                <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-lg text-sm font-medium">
                    Mantenimiento
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Capacidad</p>
                    <p class="text-white font-semibold">12 estaciones</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Ocupación actual</p>
                    <p class="text-white font-semibold">0 estudiantes</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Responsable</p>
                    <p class="text-white font-semibold">Ing. Hernández López</p>
                </div>
                <div class="bg-gray-800/50 rounded-lg p-3">
                    <p class="text-gray-400 text-sm">Horario</p>
                    <p class="text-white font-semibold">8:00 - 16:00</p>
                </div>
            </div>

            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-400 mb-2">
                    <span>Ocupación</span>
                    <span>0% (0/12) - En mantenimiento</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-yellow-600 h-2 rounded-full animate-pulse" style="width: 100%"></div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="text-white font-medium mb-2">Equipos principales</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Herramientas de Diagnóstico</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Estaciones de Soldadura</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Multímetros</span>
                    <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">Osciloscopios</span>
                </div>
            </div>

            <div class="flex space-x-2">
                <button onclick="verDetallesLab('hardware')" 
                        class="flex-1 px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors text-sm">
                    Ver Detalles
                </button>
                <button onclick="programarMantenimiento('hardware')" 
                        class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Panel de alertas y notificaciones -->
    <div class="glass-dark rounded-xl p-6">
        <h3 class="text-xl font-semibold text-white mb-4">Alertas y Notificaciones</h3>
        <div class="space-y-3">
            <div class="flex items-center space-x-4 p-3 bg-yellow-600/10 border border-yellow-500/20 rounded-lg">
                <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                <div class="flex-1">
                    <p class="text-white font-medium">Mantenimiento programado</p>
                    <p class="text-gray-400 text-sm">Lab. Hardware requiere mantenimiento preventivo - Finaliza mañana</p>
                </div>
                <span class="text-yellow-400 text-sm">Hace 2h</span>
            </div>

            <div class="flex items-center space-x-4 p-3 bg-blue-600/10 border border-blue-500/20 rounded-lg">
                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                <div class="flex-1">
                    <p class="text-white font-medium">Nueva reserva de laboratorio</p>
                    <p class="text-gray-400 text-sm">Lab. Sistemas - Reservado para el grupo de desarrollo web</p>
                </div>
                <span class="text-blue-400 text-sm">Hace 1h</span>
            </div>

            <div class="flex items-center space-x-4 p-3 bg-green-600/10 border border-green-500/20 rounded-lg">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <div class="flex-1">
                    <p class="text-white font-medium">Equipo actualizado</p>
                    <p class="text-gray-400 text-sm">Lab. Redes - Nuevo switch Cisco instalado exitosamente</p>
                </div>
                <span class="text-green-400 text-sm">Hace 3h</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal para nuevo laboratorio -->
<div id="modalNuevoLaboratorio" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-xl p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white">Nuevo Laboratorio</h3>
            <button onclick="cerrarModal('modalNuevoLaboratorio')" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="formNuevoLaboratorio" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Nombre del Laboratorio</label>
                    <input type="text" name="nombre" required 
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Ubicación</label>
                    <input type="text" name="ubicacion" required 
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Capacidad</label>
                    <input type="number" name="capacidad" min="1" max="50" required 
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Responsable</label>
                    <select name="responsable" required 
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccionar responsable</option>
                        <option value="dr_garcia">Dr. García López</option>
                        <option value="ing_martinez">Ing. Martínez Cruz</option>
                        <option value="mc_rodriguez">M.C. Rodríguez Silva</option>
                        <option value="ing_hernandez">Ing. Hernández López</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Descripción</label>
                <textarea name="descripcion" rows="3" 
                          class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            
            <div class="flex justify-end space-x-3 pt-6">
                <button type="button" onclick="cerrarModal('modalNuevoLaboratorio')" 
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Crear Laboratorio
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function abrirModalNuevoLaboratorio() {
    document.getElementById('modalNuevoLaboratorio').classList.remove('hidden');
    document.getElementById('modalNuevoLaboratorio').classList.add('flex');
}

function cerrarModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
}

function verDetallesLab(labId) {
    // Implementar navegación a detalles del laboratorio
    window.location.href = `/jefe/laboratorios/${labId}`;
}

function gestionarLab(labId) {
    // Implementar panel de gestión del laboratorio
    alert(`Gestionar laboratorio: ${labId}`);
}

function programarMantenimiento(labId) {
    // Implementar programación de mantenimiento
    alert(`Programar mantenimiento para: ${labId}`);
}

// Manejar formulario de nuevo laboratorio
document.getElementById('formNuevoLaboratorio').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Aquí iría la lógica para enviar los datos al backend
    alert('Laboratorio creado exitosamente');
    cerrarModal('modalNuevoLaboratorio');
    
    // Recargar la página o actualizar la lista
    location.reload();
});

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modals = ['modalNuevoLaboratorio'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            cerrarModal(modalId);
        }
    });
}
</script>
@endpush
@endsection