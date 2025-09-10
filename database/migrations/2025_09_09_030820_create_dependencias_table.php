<?php

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
        // SOLO crear la tabla dependencias
        Schema::create('dependencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->text('domicilio');
            $table->string('titular', 150);
            $table->string('cargo_titular', 100);
            $table->string('responsable', 150)->nullable();
            $table->string('cargo_responsable', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('municipio', 100);
            $table->string('estado', 100);
            $table->boolean('activa')->default(true);
            $table->timestamps();
            
            // Índices
            $table->index('nombre');
            $table->index('activa');
        });
        
        // NO DEBE HABER MÁS CÓDIGO AQUÍ
        // NO CREAR LA TABLA proyectos_servicio_social AQUÍ
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependencias');
    }
};