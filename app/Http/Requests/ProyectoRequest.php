<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'dependencia_id' => 'required|exists:dependencias,id',
            'nombre_programa' => 'required|string|max:200',
            'modalidad' => 'required|in:Externa,Interna',
            'fecha_inicio' => 'required|date',
            'fecha_terminacion' => 'required|date|after:fecha_inicio',
            'actividades_realizar' => 'required|string',
            'tipo_proyecto' => 'required|string|max:100',
            'horas_totales' => 'required|integer|min:1|max:1000',
            'numero_oficio' => 'nullable|string|max:50',
        ];

        if ($this->isMethod('post')) {
            // Para crear nuevo proyecto
            $rules['estudiante_id'] = 'required|exists:estudiantes,id';
        } else {
            // Para actualizar proyecto existente
            $rules['estatus'] = 'required|in:Registrado,Aceptado,En Proceso,Terminado,Cancelado';
            $rules['horas_acumuladas'] = 'required|integer|min:0|lte:horas_totales';
            $rules['actividades_principales'] = 'nullable|string';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'estudiante_id.required' => 'Debe seleccionar un estudiante.',
            'estudiante_id.exists' => 'El estudiante seleccionado no existe.',
            'dependencia_id.required' => 'Debe seleccionar una dependencia.',
            'dependencia_id.exists' => 'La dependencia seleccionada no existe.',
            'nombre_programa.required' => 'El nombre del programa es obligatorio.',
            'modalidad.required' => 'La modalidad es obligatoria.',
            'modalidad.in' => 'La modalidad debe ser Externa o Interna.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_terminacion.required' => 'La fecha de terminación es obligatoria.',
            'fecha_terminacion.date' => 'La fecha de terminación debe ser una fecha válida.',
            'fecha_terminacion.after' => 'La fecha de terminación debe ser posterior a la fecha de inicio.',
            'actividades_realizar.required' => 'Las actividades a realizar son obligatorias.',
            'tipo_proyecto.required' => 'El tipo de proyecto es obligatorio.',
            'horas_totales.required' => 'Las horas totales son obligatorias.',
            'horas_totales.min' => 'Las horas totales deben ser mínimo 1.',
            'horas_totales.max' => 'Las horas totales no pueden exceder 1000.',
            'horas_acumuladas.min' => 'Las horas acumuladas no pueden ser negativas.',
            'horas_acumuladas.lte' => 'Las horas acumuladas no pueden exceder las horas totales.',
            'estatus.required' => 'El estatus es obligatorio.',
            'estatus.in' => 'El estatus seleccionado no es válido.',
        ];
    }
}