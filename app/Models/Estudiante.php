<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_control',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'sexo',
        'telefono',
        'correo_electronico',
        'domicilio',
        'carrera',
        'periodo',
        'semestre',
        'creditos'
    ];

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    // Relación con proyectos de servicio social
    public function proyectosServicioSocial()
    {
        return $this->hasMany(ProyectoServicioSocial::class);
    }

    // Proyecto actual (en proceso)
    public function proyectoActual()
    {
        return $this->hasOne(ProyectoServicioSocial::class)
                    ->whereIn('estatus', ['Registrado', 'Aceptado', 'En Proceso'])
                    ->latest();
    }
}