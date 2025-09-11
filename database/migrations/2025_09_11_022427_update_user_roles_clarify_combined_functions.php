<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // La estructura de roles se mantiene como estaba:
        // - jefe_departamento (Jefe de Departamento + Coordinador SS)
        // - responsable_proyecto (Jefe de Laboratorio + Responsable de Proyecto)  
        // - estudiante
        
        // Actualizar los nombres de usuarios existentes para reflejar las funciones combinadas
        DB::table('users')
            ->where('role', 'jefe_departamento')
            ->update([
                'name' => 'Jefe de Departamento / Coordinador SS'
            ]);
            
        DB::table('users')
            ->where('role', 'responsable_proyecto')
            ->update([
                'name' => 'Jefe de Laboratorio / Responsable de Proyecto'
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir los nombres
        DB::table('users')
            ->where('role', 'jefe_departamento')
            ->update([
                'name' => 'Jefe de Departamento'
            ]);
            
        DB::table('users')
            ->where('role', 'responsable_proyecto')
            ->update([
                'name' => 'Responsable de Proyecto'
            ]);
    }
};