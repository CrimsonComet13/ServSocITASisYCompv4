<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\Dependencia;

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Ejecutar seeders en orden
        $this->call([
            DependenciaSeeder::class,
            EstudianteSeeder::class,
            UserSeeder::class,
            ProyectoSeeder::class,
        ]);

        echo "\n=== Base de datos poblada exitosamente ===\n";
        echo "Usuarios de prueba disponibles:\n";
        echo "Jefe de Departamento: jefe.sistemas@tecnm.mx / password123\n";
        echo "Responsable: francisco.sanchez@tecnm.mx / password123\n";
        echo "Estudiante: luis.romo@tecnm.mx / password123\n";
        echo "==========================================\n";
    }
}