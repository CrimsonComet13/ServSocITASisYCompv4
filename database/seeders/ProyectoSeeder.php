<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyectoServicioSocial;
use App\Models\Estudiante;
use App\Models\Dependencia;
use Carbon\Carbon;

class ProyectoSeeder extends Seeder
{
    public function run()
    {
        $dependenciaITA = Dependencia::where('nombre', 'INSTITUTO TECNOLÓGICO DE AGUASCALIENTES')->first();
        $dependenciaPresidencia = Dependencia::where('nombre', 'PRESIDENCIA MUNICIPAL DE AGUASCALIENTES')->first();
        $dependenciaSEP = Dependencia::where('nombre', 'SECRETARÍA DE EDUCACIÓN PÚBLICA')->first();
        $dependenciaHospital = Dependencia::where('nombre', 'HOSPITAL GENERAL DE AGUASCALIENTES')->first();

        $proyectos = [
            [
                'estudiante' => Estudiante::where('numero_control', '11150703')->first(),
                'dependencia' => $dependenciaITA,
                'nombre_programa' => 'Gestión Tecnológica y Vinculación',
                'modalidad' => 'Interna',
                'fecha_inicio' => '2025-01-27',
                'fecha_terminacion' => '2025-07-29',
                'actividades_realizar' => 'Apoyo en gestión de proyectos de vinculación, actualización de base de datos, elaboración de reportes estadísticos.',
                'tipo_proyecto' => 'Desarrollo tecnológico',
                'estatus' => 'Aceptado',
                'horas_totales' => 500,
                'horas_acumuladas' => 120,
                'fecha_carta_aceptacion' => '2025-01-27',
            ],
            [
                'estudiante' => Estudiante::where('numero_control', '12150100')->first(),
                'dependencia' => $dependenciaPresidencia,
                'nombre_programa' => 'Modernización de Sistemas Administrativos',
                'modalidad' => 'Externa',
                'fecha_inicio' => '2024-08-19',
                'fecha_terminacion' => '2025-02-21',
                'actividades_realizar' => 'Desarrollo de sistema de control interno, capacitación a usuarios, documentación de procesos.',
                'tipo_proyecto' => 'Desarrollo tecnológico',
                'estatus' => 'Terminado',
                'horas_totales' => 500,
                'horas_acumuladas' => 500,
                'fecha_carta_aceptacion' => '2024-08-19',
                'fecha_carta_terminacion' => '2025-02-21',
                'actividades_principales' => 'A) DESARROLLO DE SISTEMA DE CONTROL INTERNO; B) CAPACITACIÓN A USUARIOS FINALES; C) DOCUMENTACIÓN DE PROCESOS ADMINISTRATIVOS; D) ELABORACIÓN DE MANUALES DE USUARIO; E) IMPLEMENTACIÓN DE MEJORAS AL SISTEMA',
            ],
            [
                'estudiante' => Estudiante::where('numero_control', '13150200')->first(),
                'dependencia' => $dependenciaSEP,
                'nombre_programa' => 'Desarrollo de Plataforma Educativa',
                'modalidad' => 'Externa',
                'fecha_inicio' => '2025-02-01',
                'fecha_terminacion' => '2025-08-01',
                'actividades_realizar' => 'Programación de módulos educativos, diseño de interfaces, pruebas de sistema.',
                'tipo_proyecto' => 'Educación para adultos',
                'estatus' => 'En Proceso',
                'horas_totales' => 500,
                'horas_acumuladas' => 85,
                'fecha_carta_aceptacion' => '2025-02-01',
            ],
            [
                'estudiante' => Estudiante::where('numero_control', '14150300')->first(),
                'dependencia' => $dependenciaHospital,
                'nombre_programa' => 'Sistema de Control de Equipos Médicos',
                'modalidad' => 'Externa',
                'fecha_inicio' => '2025-03-01',
                'fecha_terminacion' => '2025-09-01',
                'actividades_realizar' => 'Desarrollo de sistema de inventario, mantenimiento preventivo, reportes de equipos.',
                'tipo_proyecto' => 'Apoyo a la salud',
                'estatus' => 'Registrado',
                'horas_totales' => 500,
                'horas_acumuladas' => 0,
            ],
        ];

        foreach ($proyectos as $proyectoData) {
            if ($proyectoData['estudiante'] && $proyectoData['dependencia']) {
                ProyectoServicioSocial::create([
                    'estudiante_id' => $proyectoData['estudiante']->id,
                    'dependencia_id' => $proyectoData['dependencia']->id,
                    'nombre_programa' => $proyectoData['nombre_programa'],
                    'modalidad' => $proyectoData['modalidad'],
                    'fecha_inicio' => $proyectoData['fecha_inicio'],
                    'fecha_terminacion' => $proyectoData['fecha_terminacion'],
                    'actividades_realizar' => $proyectoData['actividades_realizar'],
                    'tipo_proyecto' => $proyectoData['tipo_proyecto'],
                    'estatus' => $proyectoData['estatus'],
                    'horas_totales' => $proyectoData['horas_totales'],
                    'horas_acumuladas' => $proyectoData['horas_acumuladas'],
                    'numero_oficio' => 'DSC-' . str_pad($proyectoData['estudiante']->id, 4, '0', STR_PAD_LEFT) . '-2025',
                    'fecha_carta_aceptacion' => $proyectoData['fecha_carta_aceptacion'] ?? null,
                    'fecha_carta_terminacion' => $proyectoData['fecha_carta_terminacion'] ?? null,
                    'actividades_principales' => $proyectoData['actividades_principales'] ?? null,
                ]);
            }
        }

        echo "Proyectos de servicio social creados exitosamente.\n";
    }
}