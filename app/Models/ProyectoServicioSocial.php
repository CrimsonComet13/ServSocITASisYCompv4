<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProyectoServicioSocial extends Model
{
    use HasFactory;

    protected $table = 'proyectos_servicio_social';

    protected $fillable = [
        'estudiante_id',
        'dependencia_id',
        'nombre_programa',
        'modalidad',
        'fecha_inicio',
        'fecha_terminacion',
        'actividades_realizar',
        'tipo_proyecto',
        'estatus',
        'horas_totales',
        'horas_acumuladas',
        'departamento',
        'numero_oficio',
        'fecha_carta_aceptacion',
        'fecha_carta_terminacion',
        'actividades_principales'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_terminacion' => 'date',
        'fecha_carta_aceptacion' => 'date',
        'fecha_carta_terminacion' => 'date',
    ];

    // Relación con estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    // Relación con dependencia
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    // Calcular porcentaje de avance
    public function getPorcentajeAvanceAttribute()
    {
        return round(($this->horas_acumuladas / $this->horas_totales) * 100, 2);
    }

    // Verificar si está terminado
    public function getEstaTerminadoAttribute()
    {
        return $this->horas_acumuladas >= $this->horas_totales;
    }

    // Días restantes
    public function getDiasRestantesAttribute()
    {
        if ($this->fecha_terminacion) {
            return Carbon::now()->diffInDays($this->fecha_terminacion, false);
        }
        return null;
    }

    // Scopes
    public function scopeEnProceso($query)
    {
        return $query->where('estatus', 'En Proceso');
    }

    public function scopeTerminados($query)
    {
        return $query->where('estatus', 'Terminado');
    }
}