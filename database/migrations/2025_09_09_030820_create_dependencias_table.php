<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyectos_servicio_social', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
            $table->foreignId('dependencia_id')->constrained('dependencias');
            $table->string('nombre_programa', 200);
            $table->enum('modalidad', ['Externa', 'Interna']);
            $table->date('fecha_inicio');
            $table->date('fecha_terminacion');
            $table->text('actividades_realizar');
            $table->string('tipo_proyecto', 100);
            $table->enum('estatus', ['Registrado', 'Aceptado', 'En Proceso', 'Terminado', 'Cancelado'])->default('Registrado');
            $table->integer('horas_totales')->default(500);
            $table->integer('horas_acumuladas')->default(0);
            $table->string('departamento', 100)->default('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN');
            $table->string('numero_oficio', 50)->nullable();
            
            // Campos adicionales para las cartas
            $table->date('fecha_carta_aceptacion')->nullable();
            $table->date('fecha_carta_terminacion')->nullable();
            $table->text('actividades_principales')->nullable(); // Para carta de terminación
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyectos_servicio_social');
    }
};