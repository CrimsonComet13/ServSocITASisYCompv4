<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Dependencia;
use App\Models\ResponsableProyecto;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'servicio:create-user 
                            {role : El rol del usuario (jefe_departamento, responsable_proyecto, estudiante)}
                            {--name= : Nombre completo del usuario}
                            {--email= : Email del usuario}
                            {--password= : Contraseña del usuario}
                            {--numero-control= : Número de control (solo para estudiantes)}
                            {--dependencia-id= : ID de la dependencia (para responsables)}';

    /**
     * The console command description.
     */
    protected $description = 'Crear usuarios para el sistema de servicio social';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = $this->argument('role');
        
        // Validar rol
        if (!in_array($role, ['jefe_departamento', 'responsable_proyecto', 'estudiante'])) {
            $this->error('Rol inválido. Use: jefe_departamento, responsable_proyecto, o estudiante');
            return 1;
        }

        // Obtener datos
        $name = $this->option('name') ?? $this->ask('Nombre completo');
        $email = $this->option('email') ?? $this->ask('Email');
        $password = $this->option('password') ?? $this->secret('Contraseña');

        // Validar email único
        if (User::where('email', $email)->exists()) {
            $this->error('El email ya existe en el sistema');
            return 1;
        }

        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
            'activo' => true,
        ];

        // Lógica específica por rol
        switch ($role) {
            case 'estudiante':
                $numeroControl = $this->option('numero-control') ?? $this->ask('Número de control');
                
                // Buscar estudiante existente
                $estudiante = Estudiante::where('numero_control', $numeroControl)->first();
                
                if (!$estudiante) {
                    if ($this->confirm('¿Desea crear un nuevo registro de estudiante?')) {
                        $estudiante = $this->crearEstudiante($numeroControl);
                    } else {
                        $this->error('Estudiante no encontrado');
                        return 1;
                    }
                }

                $userData['numero_control'] = $numeroControl;
                $userData['estudiante_id'] = $estudiante->id;
                break;

            case 'responsable_proyecto':
                $dependencias = Dependencia::activas()->get();
                
                if ($dependencias->isEmpty()) {
                    $this->error('No hay dependencias activas en el sistema');
                    return 1;
                }

                $this->table(['ID', 'Dependencia'], $dependencias->map(function($dep) {
                    return [$dep->id, $dep->nombre];
                }));

                $dependenciaId = $this->option('dependencia-id') ?? $this->ask('ID de la dependencia');
                $dependencia = Dependencia::find($dependenciaId);

                if (!$dependencia) {
                    $this->error('Dependencia no encontrada');
                    return 1;
                }

                $userData['dependencia_id'] = $dependenciaId;
                break;
        }

        // Crear usuario
        $user = User::create($userData);

        // Crear perfil adicional para responsable
        if ($role === 'responsable_proyecto') {
            $cargo = $this->ask('Cargo del responsable');
            $telefono = $this->ask('Teléfono (opcional)');
            
            ResponsableProyecto::create([
                'user_id' => $user->id,
                'dependencia_id' => $dependenciaId,
                'nombre_completo' => $name,
                'cargo' => $cargo,
                'telefono' => $telefono,
                'email_institucional' => $email,
            ]);
        }

        $this->info("Usuario creado exitosamente:");
        $this->line("Nombre: {$name}");
        $this->line("Email: {$email}");
        $this->line("Rol: {$role}");
        $this->line("ID: {$user->id}");

        return 0;
    }

    private function crearEstudiante($numeroControl)
    {
        $apellidoPaterno = $this->ask('Apellido paterno');
        $apellidoMaterno = $this->ask('Apellido materno');
        $nombres = $this->ask('Nombres');
        $sexo = $this->choice('Sexo', ['M', 'F']);
        $telefono = $this->ask('Teléfono');
        $correo = $this->ask('Correo electrónico');
        $domicilio = $this->ask('Domicilio');
        $carrera = $this->ask('Carrera');
        $periodo = $this->ask('Periodo');
        $semestre = $this->ask('Semestre');
        $creditos = $this->ask('Créditos');

        return Estudiante::create([
            'numero_control' => $numeroControl,
            'apellido_paterno' => $apellidoPaterno,
            'apellido_materno' => $apellidoMaterno,
            'nombres' => $nombres,
            'sexo' => $sexo,
            'telefono' => $telefono,
            'correo_electronico' => $correo,
            'domicilio' => $domicilio,
            'carrera' => $carrera,
            'periodo' => $periodo,
            'semestre' => (int)$semestre,
            'creditos' => (int)$creditos,
        ]);
    }
}