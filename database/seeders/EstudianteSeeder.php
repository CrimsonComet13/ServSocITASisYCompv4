<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        $estudiantes = [
            [
                'numero_control' => '21190456',
                'apellido_paterno' => 'MARTÍNEZ',
                'apellido_materno' => 'SALAZAR',
                'nombres' => 'ANA SOFÍA',
                'sexo' => 'F',
                'telefono' => '4497654321',
                'correo_electronico' => 'ana.martinez@tecnm.mx',
                'domicilio' => 'Av. Universidad No. 456, Fracc. Las Américas, Aguascalientes, Ags.',
                'carrera' => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
                'periodo' => '2025-1',
                'semestre' => 6,
                'creditos' => 210
            ],
            [
                'numero_control' => '20180567',
                'apellido_paterno' => 'HERNÁNDEZ',
                'apellido_materno' => 'LOZANO',
                'nombres' => 'CARLOS EDUARDO',
                'sexo' => 'M',
                'telefono' => '4493344556',
                'correo_electronico' => 'carlos.hernandez@tecnm.mx',
                'domicilio' => 'Calle Fresno No. 89, Col. Jardines, Aguascalientes, Ags.',
                'carrera' => 'INGENIERÍA INDUSTRIAL',
                'periodo' => '2025-1',
                'semestre' => 7,
                'creditos' => 245,
            ],
            [
                'numero_control' => '21170234',
                'apellido_paterno' => 'GONZÁLEZ',
                'apellido_materno' => 'VILLALOBOS',
                'nombres' => 'MARÍA FERNANDA',
                'sexo' => 'F',
                'telefono' => '4499988776',
                'correo_electronico' => 'maria.gonzalez@tecnm.mx',
                'domicilio' => 'Privada Diamante No. 12, Col. Morelos, Aguascalientes, Ags.',
                'carrera' => 'LICENCIATURA EN ADMINISTRACIÓN',
                'periodo' => '2025-1',
                'semestre' => 4,
                'creditos' => 190,
            ],
            [
                'numero_control' => '22160589',
                'apellido_paterno' => 'RAMÍREZ',
                'apellido_materno' => 'ORTEGA',
                'nombres' => 'DANIEL ALEJANDRO',
                'sexo' => 'M',
                'telefono' => '4495566778',
                'correo_electronico' => 'daniel.ramirez@tecnm.mx',
                'domicilio' => 'Calle Hidalgo No. 321, Col. San Marcos, Aguascalientes, Ags.',
                'carrera' => 'INGENIERÍA MECÁNICA',
                'periodo' => '2025-1',
                'semestre' => 5,
                'creditos' => 192,
            ],
            [
                'numero_control' => '23190877',
                'apellido_paterno' => 'CASTILLO',
                'apellido_materno' => 'PÉREZ',
                'nombres' => 'VALERIA GUADALUPE',
                'sexo' => 'F',
                'telefono' => '4494433221',
                'correo_electronico' => 'valeria.castillo@tecnm.mx',
                'domicilio' => 'Blvd. Aguascalientes No. 765, Fracc. Versalles, Aguascalientes, Ags.',
                'carrera' => 'INGENIERÍA EN GESTIÓN EMPRESARIAL',
                'periodo' => '2025-1',
                'semestre' => 3,
                'creditos' => 105
            ],
        ];

        foreach ($estudiantes as $estudiante) {
            Estudiante::create($estudiante);
        }

        echo "Estudiantes creados exitosamente.\n";
    }
}