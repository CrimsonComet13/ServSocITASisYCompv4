<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\Dependencia;
use App\Models\ProyectoServicioSocial;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear dependencias de ejemplo
        $dependencias = [
            [
                'nombre_dependencia' => 'INSTITUTO TECNOLÓGICO DE AGUASCALIENTES',
                'domicilio_dependencia' => 'Av. Adolfo López Mateos No. 1801 Ote. Fracc. Bona Gens, C.P. 20256',
                'titular_dependencia' => 'DR. JOSÉ LUIS GIL VÁZQUEZ',
                'cargo_titular' => 'DIRECTOR',
                'responsable_proyecto' => 'M. C. FRANCISCO SÁNCHEZ MARES',
                'cargo_responsable' => 'JEFE DEL DEPTO. DE GESTIÓN TECNOLÓGICA Y VINCULACIÓN',
            ],
            [
                'nombre_dependencia' => 'PRESIDENCIA MUNICIPAL DE AGUASCALIENTES',
                'domicilio_dependencia' => 'Plaza de la Patria No. 1, Zona Centro, C.P. 20000',
                'titular_dependencia' => 'C. PRESIDENTE MUNICIPAL',
                'cargo_titular' => 'PRESIDENTE MUNICIPAL',
                'responsable_proyecto' => 'LIC. MARÍA GONZÁLEZ PÉREZ',
                'cargo_responsable' => 'COORDINADORA DE SISTEMAS',
            ]
        ];

        foreach ($dependencias as $dependencia) {
            Dependencia::create($dependencia);
        }

        // Crear estudiante de ejemplo
        Estudiante::create([
            'numero_control' => '11150703',
            'apellido_paterno' => 'ROMO',
            'apellido_materno' => 'RÍOS',
            'nombres' => 'LUIS OMAR',
            'sexo' => 'M',
            'telefono' => '4491234567',
            'correo_electronico' => 'luis.romo@tecnm.mx',
            'domicilio' => 'Calle Ejemplo No. 123, Col. Centro, Aguascalientes, Ags.',
            'carrera' => 'LICENCIATURA EN ADMINISTRACIÓN',
            'periodo' => '2025-1',
            'semestre' => 8,
            'creditos' => 280
        ]);

        echo "Datos de ejemplo creados exitosamente.\n";
    }
}