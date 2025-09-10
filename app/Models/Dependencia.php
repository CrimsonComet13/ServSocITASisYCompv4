<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',           // CORREGIDO: era 'nombre_dependencia'
        'domicilio',        
        'titular',          
        'cargo_titular',
        'responsable',      
        'cargo_responsable',
        'telefono',
        'email',
        'municipio',
        'estado',
        'activa'
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    // Relaciones
    public function proyectosServicioSocial()
    {
        return $this->hasMany(ProyectoServicioSocial::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function responsablesProyecto()
    {
        return $this->hasMany(ResponsableProyecto::class);
    }

    // Scopes
    public function scopeActivas($query)
    {
        return $query->where('activa', true);
    }

    // Accessors
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} - {$this->titular}";
    }
}