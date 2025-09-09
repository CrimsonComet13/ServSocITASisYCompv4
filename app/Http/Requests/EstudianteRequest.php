<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstudianteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'numero_control' => 'required|string|max:20',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'nombres' => 'required|string|max:100',
            'sexo' => 'required|in:M,F',
            'telefono' => 'required|string|max:15',
            'correo_electronico' => 'required|email|max:100',
            'domicilio' => 'required|string',
            'carrera' => 'required|string|max:150',
            'periodo' => 'required|string|max:20',
            'semestre' => 'required|integer|min:1|max:12',
            'creditos' => 'required|integer|min:0',
        ];

        if ($this->isMethod('post')) {
            // Para crear nuevo estudiante
            $rules['numero_control'] .= '|unique:estudiantes';
            $rules['correo_electronico'] .= '|unique:estudiantes';
        } else {
            // Para actualizar estudiante existente
            $estudianteId = $this->route('estudiante') ? $this->route('estudiante')->id : null;
            $rules['numero_control'] .= '|' . Rule::unique('estudiantes')->ignore($estudianteId);
            $rules['correo_electronico'] .= '|' . Rule::unique('estudiantes')->ignore($estudianteId);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'numero_control.required' => 'El número de control es obligatorio.',
            'numero_control.unique' => 'Este número de control ya está registrado.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'nombres.required' => 'El nombre es obligatorio.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.in' => 'El sexo debe ser M (Masculino) o F (Femenino).',
            'telefono.required' => 'El teléfono es obligatorio.',
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El correo electrónico debe tener un formato válido.',
            'correo_electronico.unique' => 'Este correo electrónico ya está registrado.',
            'domicilio.required' => 'El domicilio es obligatorio.',
            'carrera.required' => 'La carrera es obligatoria.',
            'periodo.required' => 'El periodo es obligatorio.',
            'semestre.required' => 'El semestre es obligatorio.',
            'semestre.min' => 'El semestre debe ser mínimo 1.',
            'semestre.max' => 'El semestre debe ser máximo 12.',
            'creditos.required' => 'Los créditos son obligatorios.',
            'creditos.min' => 'Los créditos no pueden ser negativos.',
        ];
    }
}