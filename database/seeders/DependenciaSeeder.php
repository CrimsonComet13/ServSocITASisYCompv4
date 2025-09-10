<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dependencia;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dependencias = [
            [
                'nombre' => 'INSTITUTO TECNOLÓGICO DE AGUASCALIENTES',  // NO nombre_dependencia
                'domicilio' => 'Av. Adolfo López Mateos No. 1801 Ote. Fracc. Bona Gens, C.P. 20256',  // NO domicilio_dependencia
                'titular' => 'DR. JOSÉ LUIS GIL VÁZQUEZ',  // NO titular_dependencia
                'cargo_titular' => 'DIRECTOR',
                'responsable' => 'M. C. FRANCISCO SÁNCHEZ MARES',  // NO responsable_proyecto
                'cargo_responsable' => 'JEFE DEL DEPTO. DE GESTIÓN TECNOLÓGICA Y VINCULACIÓN',
                'telefono' => '449-910-5002',
                'email' => 'vinculacion@ita.edu.mx',
                'municipio' => 'Aguascalientes',
                'estado' => 'Aguascalientes',
                'activa' => true,
            ],
            [
                'nombre' => 'HOSPITAL GENERAL DE AGUASCALIENTES',
                'domicilio' => 'Av. Universidad No. 1501, Col. Bosques del Prado Sur',
                'titular' => 'DRA. MARÍA GARCÍA LÓPEZ',
                'cargo_titular' => 'DIRECTORA GENERAL',
                'responsable' => 'LIC. JUAN PÉREZ MARTÍNEZ',
                'cargo_responsable' => 'JEFE DE RECURSOS HUMANOS',
                'telefono' => '449-974-3000',
                'email' => 'contacto@hga.gob.mx',
                'municipio' => 'Aguascalientes',
                'estado' => 'Aguascalientes',
                'activa' => true,
            ],
            [
                'nombre' => 'SECRETARÍA DE EDUCACIÓN PÚBLICA',
                'domicilio' => 'Av. Héroe de Nacozari Sur No. 2301',
                'titular' => 'MTRO. CARLOS HERNÁNDEZ RUIZ',
                'cargo_titular' => 'SECRETARIO DE EDUCACIÓN',
                'responsable' => 'LIC. ANA RODRÍGUEZ SILVA',
                'cargo_responsable' => 'COORDINADORA DE VINCULACIÓN',
                'telefono' => '449-910-2600',
                'email' => 'vinculacion@iea.gob.mx',
                'municipio' => 'Aguascalientes',
                'estado' => 'Aguascalientes',
                'activa' => true,
            ],
            [
                'nombre' => 'MUNICIPIO DE AGUASCALIENTES',
                'domicilio' => 'Plaza de la Patria S/N, Zona Centro',
                'titular' => 'LIC. ROBERTO MENDOZA TORRES',
                'cargo_titular' => 'PRESIDENTE MUNICIPAL',
                'responsable' => 'ING. LAURA SÁNCHEZ PÉREZ',
                'cargo_responsable' => 'DIRECTORA DE DESARROLLO SOCIAL',
                'telefono' => '449-949-4900',
                'email' => 'municipio@ags.gob.mx',
                'municipio' => 'Aguascalientes',
                'estado' => 'Aguascalientes',
                'activa' => true,
            ],
            [
                'nombre' => 'INSTITUTO DE SALUD DEL ESTADO',
                'domicilio' => 'Margil de Jesús No. 1501',
                'titular' => 'DR. FERNANDO LÓPEZ GONZÁLEZ',
                'cargo_titular' => 'DIRECTOR GENERAL',
                'responsable' => 'DRA. PATRICIA MORALES DÍAZ',
                'cargo_responsable' => 'JEFA DE ENSEÑANZA',
                'telefono' => '449-910-7900',
                'email' => 'isea@aguascalientes.gob.mx',
                'municipio' => 'Aguascalientes',
                'estado' => 'Aguascalientes',
                'activa' => true,
            ],
        ];

        foreach ($dependencias as $dependencia) {
            Dependencia::create($dependencia);
        }
    }
}