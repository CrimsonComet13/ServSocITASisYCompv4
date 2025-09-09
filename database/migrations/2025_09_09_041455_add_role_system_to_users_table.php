<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['jefe_departamento', 'responsable_proyecto', 'estudiante'])->default('estudiante');
            $table->string('numero_control')->nullable()->unique(); // Para estudiantes
            $table->foreignId('estudiante_id')->nullable()->constrained('estudiantes')->onDelete('cascade'); // Relación con estudiante
            $table->foreignId('dependencia_id')->nullable()->constrained('dependencias')->onDelete('set null'); // Para responsables
            $table->boolean('activo')->default(true);
            $table->timestamp('ultimo_acceso')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 
                'numero_control', 
                'estudiante_id', 
                'dependencia_id', 
                'activo', 
                'ultimo_acceso'
            ]);
        });
    }
};