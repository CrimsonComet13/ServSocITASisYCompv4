<?php

namespace App\Http\Controllers;

use App\Models\ProyectoServicioSocial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DocumentoController extends Controller
{
    /**
     * Generar Carta de Aceptación
     */
    public function cartaAceptacion(ProyectoServicioSocial $proyecto)
    {
        // Verificar que el proyecto esté en estado apropiado
        if (!in_array($proyecto->estatus, ['Aceptado', 'En Proceso', 'Terminado'])) {
            return back()->with('error', 'El proyecto debe estar aceptado para generar la carta de aceptación.');
        }

        $proyecto->load(['estudiante', 'dependencia']);
        
        // Actualizar fecha de carta de aceptación si no existe
        if (!$proyecto->fecha_carta_aceptacion) {
            $proyecto->fecha_carta_aceptacion = Carbon::now()->toDateString();
            $proyecto->save();
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fecha_carta' => $proyecto->fecha_carta_aceptacion,
            'fecha_formateada' => $this->formatearFecha($proyecto->fecha_carta_aceptacion),
            'fecha_inicio_formateada' => $this->formatearFecha($proyecto->fecha_inicio),
            'fecha_fin_formateada' => $this->formatearFecha($proyecto->fecha_terminacion),
        ];

        $pdf = Pdf::loadView('documentos.carta-aceptacion', $data);
        $pdf->setPaper('letter');
        
        $nombreArchivo = "Carta_Aceptacion_{$proyecto->estudiante->numero_control}_{$proyecto->fecha_carta_aceptacion}.pdf";
        
        return $pdf->download($nombreArchivo);
    }

    /**
     * Generar Carta de Terminación
     */
    public function cartaTerminacion(ProyectoServicioSocial $proyecto)
    {
        // Verificar que el proyecto esté terminado
        if ($proyecto->estatus !== 'Terminado') {
            return back()->with('error', 'El proyecto debe estar terminado para generar la carta de terminación.');
        }

        $proyecto->load(['estudiante', 'dependencia']);
        
        // Actualizar fecha de carta de terminación si no existe
        if (!$proyecto->fecha_carta_terminacion) {
            $proyecto->fecha_carta_terminacion = Carbon::now()->toDateString();
            $proyecto->save();
        }

        // Verificar que tenga actividades principales definidas
        if (!$proyecto->actividades_principales) {
            return back()->with('error', 'Debe definir las actividades principales realizadas antes de generar la carta de terminación.');
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fecha_carta' => $proyecto->fecha_carta_terminacion,
            'fecha_formateada' => $this->formatearFecha($proyecto->fecha_carta_terminacion),
            'fecha_inicio_formateada' => $this->formatearFecha($proyecto->fecha_inicio),
            'fecha_fin_formateada' => $this->formatearFecha($proyecto->fecha_terminacion),
            'actividades' => $this->procesarActividades($proyecto->actividades_principales),
        ];

        $pdf = Pdf::loadView('documentos.carta-terminacion', $data);
        $pdf->setPaper('letter');
        
        $nombreArchivo = "Carta_Terminacion_{$proyecto->estudiante->numero_control}_{$proyecto->fecha_carta_terminacion}.pdf";
        
        return $pdf->download($nombreArchivo);
    }

    /**
     * Generar Solicitud de Servicio Social
     */
    public function solicitudServicio(ProyectoServicioSocial $proyecto)
    {
        $proyecto->load(['estudiante', 'dependencia']);
        
        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
        ];

        $pdf = Pdf::loadView('documentos.solicitud-servicio', $data);
        $pdf->setPaper('letter');
        
        $nombreArchivo = "Solicitud_Servicio_{$proyecto->estudiante->numero_control}.pdf";
        
        return $pdf->download($nombreArchivo);
    }

    /**
     * Vista previa de documentos
     */
    public function preview(ProyectoServicioSocial $proyecto, $tipo)
    {
        switch ($tipo) {
            case 'aceptacion':
                return $this->previewAceptacion($proyecto);
            case 'terminacion':
                return $this->previewTerminacion($proyecto);
            case 'solicitud':
                return $this->previewSolicitud($proyecto);
            default:
                abort(404);
        }
    }

    private function previewAceptacion(ProyectoServicioSocial $proyecto)
    {
        $proyecto->load(['estudiante', 'dependencia']);
        
        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fecha_carta' => $proyecto->fecha_carta_aceptacion ?: Carbon::now()->toDateString(),
            'fecha_formateada' => $this->formatearFecha($proyecto->fecha_carta_aceptacion ?: Carbon::now()->toDateString()),
            'fecha_inicio_formateada' => $this->formatearFecha($proyecto->fecha_inicio),
            'fecha_fin_formateada' => $this->formatearFecha($proyecto->fecha_terminacion),
        ];

        return view('documentos.carta-aceptacion', $data);
    }

    private function previewTerminacion(ProyectoServicioSocial $proyecto)
    {
        $proyecto->load(['estudiante', 'dependencia']);
        
        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fecha_carta' => $proyecto->fecha_carta_terminacion ?: Carbon::now()->toDateString(),
            'fecha_formateada' => $this->formatearFecha($proyecto->fecha_carta_terminacion ?: Carbon::now()->toDateString()),
            'fecha_inicio_formateada' => $this->formatearFecha($proyecto->fecha_inicio),
            'fecha_fin_formateada' => $this->formatearFecha($proyecto->fecha_terminacion),
            'actividades' => $this->procesarActividades($proyecto->actividades_principales ?: 'Actividades por definir'),
        ];

        return view('documentos.carta-terminacion', $data);
    }

    private function previewSolicitud(ProyectoServicioSocial $proyecto)
    {
        $proyecto->load(['estudiante', 'dependencia']);
        
        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
        ];

        return view('documentos.solicitud-servicio', $data);
    }

    /**
     * Formatear fecha a texto español
     */
    private function formatearFecha($fecha)
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
     * Procesar actividades para formato de carta
     */
    private function procesarActividades($actividades)
    {
        // Si las actividades ya están en formato A) B) C), las devolvemos tal como están
        if (strpos($actividades, 'A)') !== false || strpos($actividades, 'a)') !== false) {
            return $actividades;
        }

        // Si son actividades separadas por saltos de línea, las convertimos a formato A) B) C)
        $lineas = explode("\n", $actividades);
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