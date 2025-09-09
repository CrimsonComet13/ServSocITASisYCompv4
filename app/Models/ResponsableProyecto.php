<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableProyecto extends Model
{
    use HasFactory;

    protected $table = 'responsables_proyecto';

    protected $fillable = [
        'user_id',
        'dependencia_id',
        'nombre_completo',
        'cargo',
        'telefono',
        'email_institucional',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    // Proyectos que supervisa
    public function proyectosSupervisa()
    {
        return $this->hasManyThrough(
            ProyectoServicioSocial::class,
            Dependencia::class,
            'id', // Foreign key on dependencias table
            'dependencia_id', // Foreign key on proyectos table
            'dependencia_id', // Local key on responsables table
            'id' // Local key on dependencias table
        );
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Verificar si puede evaluar un proyecto
    public function canEvaluateProject($proyecto)
    {
        return $this->dependencia_id === $proyecto->dependencia_id && $this->activo;
    }
}