<?php

namespace App\Helpers;

use Carbon\Carbon;

class ServicioSocialHelper
{
    /**
     * Formatear fecha a español
     */
    public static function formatearFecha($fecha)
    {
        $meses = [
            1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
        ];

        $fechaCarbon = Carbon::parse($fecha);
        $dia = $fechaCarbon->day;
        $mes = $meses[$fechaCarbon->month];
        $año = $fechaCarbon->year;

        return "{$dia} de {$mes} de {$año}";
    }

    /**
     * Generar número de oficio automático
     */
    public static function generarNumeroOficio()
    {
        $año = Carbon::now()->year;
        $consecutivo = \App\Models\ProyectoServicioSocial::whereYear('created_at', $año)->count() + 1;
        
        return sprintf('DSC-%04d-%d', $consecutivo, $año);
    }

    /**
     * Calcular días hábiles entre dos fechas
     */
    public static function calcularDiasHabiles($fechaInicio, $fechaFin)
    {
        $inicio = Carbon::parse($fechaInicio);
        $fin = Carbon::parse($fechaFin);
        $diasHabiles = 0;

        while ($inicio->lte($fin)) {
            // Lunes = 1, Domingo = 7
            if ($inicio->dayOfWeek >= 1 && $inicio->dayOfWeek <= 5) {
                $diasHabiles++;
            }
            $inicio->addDay();
        }

        return $diasHabiles;
    }

    /**
     * Obtener estatus con color para la UI
     */
    public static function getEstatusConColor($estatus)
    {
        $colores = [
            'Registrado' => ['color' => 'blue', 'texto' => 'Registrado'],
            'Aceptado' => ['color' => 'green', 'texto' => 'Aceptado'],
            'En Proceso' => ['color' => 'yellow', 'texto' => 'En Proceso'],
            'Terminado' => ['color' => 'purple', 'texto' => 'Terminado'],
            'Cancelado' => ['color' => 'red', 'texto' => 'Cancelado'],
        ];

        return $colores[$estatus] ?? ['color' => 'gray', 'texto' => 'Desconocido'];
    }

    /**
     * Validar si un estudiante puede registrar servicio social
     */
    public static function puedeRegistrarServicio($estudiante)
    {
        $creditosMinimos = ($estudiante->creditos * 70) / 100;
        
        return [
            'puede' => $estudiante->creditos >= $creditosMinimos,
            'creditos_necesarios' => $creditosMinimos,
            'mensaje' => $estudiante->creditos >= $creditosMinimos 
                ? 'El estudiante cumple con los requisitos para registrar servicio social.'
                : "El estudiante necesita al menos {$creditosMinimos} créditos (70% de la carrera)."
        ];
    }

    /**
     * Obtener tipos de proyecto disponibles
     */
    public static function getTiposProyecto()
    {
        return [
            'Educación para adultos',
            'Desarrollo de comunidad',
            'Actividades deportivas',
            'Actividades culturales',
            'Actividades cívicas',
            'Desarrollo Sustentable',
            'Apoyo a la salud',
            'Medio ambiente',
            'Desarrollo tecnológico',
            'Apoyo administrativo',
            'Otros'
        ];
    }

    /**
     * Obtener carreras del Instituto
     */
    public static function getCarreras()
    {
        return [
            'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
            'INGENIERÍA INDUSTRIAL',
            'INGENIERÍA MECÁNICA',
            'INGENIERÍA ELÉCTRICA',
            'INGENIERÍA ELECTRÓNICA',
            'INGENIERÍA QUÍMICA',
            'INGENIERÍA EN GESTIÓN EMPRESARIAL',
            'LICENCIATURA EN ADMINISTRACIÓN',
            'CONTADOR PÚBLICO',
            'INGENIERÍA CIVIL',
            'ARQUITECTURA',
            'INGENIERÍA MECATRÓNICA'
        ];
    }

    /**
     * Procesar actividades para formato de carta
     */
    public static function procesarActividades($actividades)
    {
        if (empty($actividades)) {
            return 'ACTIVIDADES POR DEFINIR';
        }

        // Si las actividades ya están en formato A) B) C), las devolvemos tal como están
        if (strpos(strtoupper($actividades), 'A)') !== false) {
            return strtoupper($actividades);
        }

        // Si son actividades separadas por saltos de línea o punto y coma, las convertimos
        $separadores = ["\n", ";", "|"];
        $lineas = [$actividades];
        
        foreach ($separadores as $separador) {
            if (strpos($actividades, $separador) !== false) {
                $lineas = explode($separador, $actividades);
                break;
            }
        }

        $actividadesFormateadas = [];
        $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        
        foreach ($lineas as $index => $linea) {
            $linea = trim($linea);
            if (!empty($linea) && isset($letras[$index])) {
                $actividadesFormateadas[] = $letras[$index] . ') ' . strtoupper($linea);
            }
        }

        return implode('; ', $actividadesFormateadas);
    }
}