<?php
// Archivo: 2025_09_09_030825_create_proyectos_servicio_social_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyectos_servicio_social', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('dependencia_id');
            $table->string('nombre_programa', 200);
            $table->enum('modalidad', ['Externa', 'Interna']);
            $table->date('fecha_inicio');
            $table->date('fecha_terminacion');
            $table->text('actividades_realizar');
            $table->string('tipo_proyecto', 100);
            $table->enum('estatus', ['Registrado', 'Aceptado', 'En Proceso', 'Terminado', 'Cancelado'])
                  ->default('Registrado');
            $table->integer('horas_totales')->default(500);
            $table->integer('horas_acumuladas')->default(0);
            $table->string('departamento', 100)->default('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN');
            $table->string('numero_oficio', 50)->nullable();
            $table->date('fecha_carta_aceptacion')->nullable();
            $table->date('fecha_carta_terminacion')->nullable();
            $table->text('actividades_principales')->nullable();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('estudiante_id')
                  ->references('id')
                  ->on('estudiantes')
                  ->onDelete('cascade');
                  
            $table->foreign('dependencia_id')
                  ->references('id')
                  ->on('dependencias')
                  ->onDelete('restrict');
            
            // Índices
            $table->index('estatus');
            $table->index('fecha_inicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos_servicio_social');
    }
};