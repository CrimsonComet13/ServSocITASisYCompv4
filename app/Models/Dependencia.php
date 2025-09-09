<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_dependencia',
        'domicilio_dependencia',
        'titular_dependencia',
        'cargo_titular',
        'responsable_proyecto',
        'cargo_responsable',
        'municipio',
        'estado',
        'activa'
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    // Relación con proyectos de servicio social
    public function proyectosServicioSocial()
    {
        return $this->hasMany(ProyectoServicioSocial::class);
    }

    // Scope para dependencias activas
    public function scopeActivas($query)
    {
        return $query->where('activa', true);
    }
}