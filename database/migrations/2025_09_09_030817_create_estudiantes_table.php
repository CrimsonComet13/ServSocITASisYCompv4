<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_control', 20)->unique();
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->string('nombres', 100);
            $table->enum('sexo', ['M', 'F']);
            $table->string('telefono', 15);
            $table->string('correo_electronico', 100)->unique();
            $table->text('domicilio');
            $table->string('carrera', 150);
            $table->string('periodo', 20);
            $table->integer('semestre');
            $table->integer('creditos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};