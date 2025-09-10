<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Dependencia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // IMPORTANTE: Limpiar usuarios completamente
        $this->command->info('Limpiando tabla users...');
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        
        // 1. Crear Admin
        User::create([
            'name' => 'Admin Sistema',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'),
            'role' => 'jefe_departamento',
            'activo' => true,
            'email_verified_at' => now(),
        ]);
        $this->command->info('✓ Admin creado: admin@test.com');

        // 2. Crear Responsable
        $dep = Dependencia::where('nombre', 'INSTITUTO TECNOLÓGICO DE AGUASCALIENTES')->first();
        if ($dep) {
            User::create([
                'name' => 'Responsable Test',
                'email' => 'responsable@test.com',
                'password' => Hash::make('responsable123'),
                'role' => 'responsable_proyecto',
                'dependencia_id' => $dep->id,
                'activo' => true,
                'email_verified_at' => now(),
            ]);
            $this->command->info('✓ Responsable creado: responsable@test.com');
        }

        // 3. Crear Estudiante - usando un estudiante aleatorio
        $estudiante = Estudiante::inRandomOrder()->first();
        if ($estudiante) {
            User::create([
                'name' => 'Estudiante Test',
                'email' => 'estudiante@test.com',
                'password' => Hash::make('estudiante123'),
                'role' => 'estudiante',
                'numero_control' => $estudiante->numero_control,
                'estudiante_id' => $estudiante->id,
                'activo' => true,
                'email_verified_at' => now(),
            ]);
            $this->command->info('✓ Estudiante creado: estudiante@test.com');
        }

        $this->command->newLine();
        $this->command->table(
            ['Email', 'Password', 'Role'],
            [
                ['admin@test.com', 'admin123', 'Jefe Departamento'],
                ['responsable@test.com', 'responsable123', 'Responsable'],
                ['estudiante@test.com', 'estudiante123', 'Estudiante'],
            ]
        );
    }
}