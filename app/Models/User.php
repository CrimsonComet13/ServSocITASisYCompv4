<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'numero_control',
        'estudiante_id',
        'dependencia_id',
        'activo',
        'ultimo_acceso'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'ultimo_acceso' => 'datetime',
        'activo' => 'boolean',
    ];

    // Relaciones
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function responsableProyecto()
    {
        return $this->hasOne(ResponsableProyecto::class);
    }

    // Métodos de roles
    public function isJefeDepartamento()
    {
        return $this->role === 'jefe_departamento';
    }

    public function isResponsableProyecto()
    {
        return $this->role === 'responsable_proyecto';
    }

    public function isEstudiante()
    {
        return $this->role === 'estudiante';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function hasAnyRole($roles)
    {
        return in_array($this->role, $roles);
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Accessors
    public function getRoleNameAttribute()
    {
        $roles = [
            'jefe_departamento' => 'Jefe de Departamento',
            'responsable_proyecto' => 'Responsable de Proyecto', 
            'estudiante' => 'Estudiante'
        ];

        return $roles[$this->role] ?? 'Sin Rol';
    }

    // Actualizar último acceso
    public function updateLastAccess()
    {
        $this->update(['ultimo_acceso' => now()]);
    }

    // Verificar si puede acceder a un proyecto específico
    public function canAccessProject($proyecto)
    {
        if ($this->isJefeDepartamento()) {
            return true; // Jefe puede acceder a todos
        }

        if ($this->isResponsableProyecto()) {
            return $this->dependencia_id === $proyecto->dependencia_id;
        }

        if ($this->isEstudiante()) {
            return $this->estudiante_id === $proyecto->estudiante_id;
        }

        return false;
    }
}