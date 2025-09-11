<?php

namespace App\Http\Controllers;

use App\Models\ProyectoServicioSocial;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    /**
     * Generar Carta de Aceptación
     */
    public function cartaAceptacion($proyectoId)
    {
        $proyecto = ProyectoServicioSocial::with(['estudiante', 'dependencia'])->findOrFail($proyectoId);
        
        // Verificar permisos
        if (!Auth::user()->canAccessProject($proyecto)) {
            abort(403, 'No tienes permisos para acceder a este documento.');
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fechaGeneracion' => now()->format('d/m/Y'),
            'institucion' => [
                'nombre' => 'TECNOLÓGICO NACIONAL DE MÉXICO',
                'campus' => 'INSTITUTO TECNOLÓGICO DE AGUASCALIENTES',
                'departamento' => 'DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN',
                'direccion' => 'Av. Adolfo López Mateos 1801 Ote. Fracc. Bona Gens',
                'ciudad' => 'Aguascalientes, Ags.',
                'cp' => '20256',
                'telefono' => '(449) 970 5002'
            ]
        ];

        $pdf = Pdf::loadView('pdf.carta-aceptacion', $data);
        $pdf->setPaper('letter', 'portrait');
        
        return $pdf->stream("Carta_Aceptacion_{$proyecto->estudiante->numero_control}.pdf");
    }

    /**
     * Generar Carta de Terminación
     */
    public function cartaTerminacion($proyectoId)
    {
        $proyecto = ProyectoServicioSocial::with(['estudiante', 'dependencia'])->findOrFail($proyectoId);
        
        if (!Auth::user()->canAccessProject($proyecto)) {
            abort(403, 'No tienes permisos para acceder a este documento.');
        }

        // Verificar que el proyecto esté terminado
        if ($proyecto->estatus !== 'Terminado') {
            return redirect()->back()->with('error', 'El proyecto debe estar terminado para generar la carta de terminación.');
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fechaGeneracion' => now()->format('d/m/Y'),
            'institucion' => [
                'nombre' => 'TECNOLÓGICO NACIONAL DE MÉXICO',
                'campus' => 'INSTITUTO TECNOLÓGICO DE AGUASCALIENTES',
                'departamento' => 'DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN',
                'direccion' => 'Av. Adolfo López Mateos 1801 Ote. Fracc. Bona Gens',
                'ciudad' => 'Aguascalientes, Ags.',
                'cp' => '20256',
                'telefono' => '(449) 970 5002'
            ]
        ];

        $pdf = Pdf::loadView('pdf.carta-terminacion', $data);
        $pdf->setPaper('letter', 'portrait');
        
        return $pdf->stream("Carta_Terminacion_{$proyecto->estudiante->numero_control}.pdf");
    }

    /**
     * Generar Solicitud de Servicio Social (ITA-VI-SS-FO-01)
     */
    public function solicitudServicioSocial($proyectoId)
    {
        $proyecto = ProyectoServicioSocial::with(['estudiante', 'dependencia'])->findOrFail($proyectoId);
        
        if (!Auth::user()->canAccessProject($proyecto)) {
            abort(403, 'No tienes permisos para acceder a este documento.');
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fechaGeneracion' => now()->format('d/m/Y'),
            'codigoFormulario' => 'ITA-VI-SS-FO-01',
            'version' => '1.0',
            'fechaVigencia' => '01/08/2023'
        ];

        $pdf = Pdf::loadView('pdf.solicitud-servicio-social', $data);
        $pdf->setPaper('letter', 'portrait');
        
        return $pdf->stream("Solicitud_SS_{$proyecto->estudiante->numero_control}.pdf");
    }

    /**
     * Generar Reporte Bimestral (ITA-VI-SS-FO-02)
     */
    public function reporteBimestral($proyectoId, $bimestre = 1)
    {
        $proyecto = ProyectoServicioSocial::with(['estudiante', 'dependencia'])->findOrFail($proyectoId);
        
        if (!Auth::user()->canAccessProject($proyecto)) {
            abort(403, 'No tienes permisos para acceder a este documento.');
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'bimestre' => $bimestre,
            'fechaGeneracion' => now()->format('d/m/Y'),
            'codigoFormulario' => 'ITA-VI-SS-FO-02',
            'version' => '1.0',
            'fechaVigencia' => '01/08/2023',
            'periodoReporte' => $this->calcularPeriodoBimestre($proyecto->fecha_inicio, $bimestre)
        ];

        $pdf = Pdf::loadView('pdf.reporte-bimestral', $data);
        $pdf->setPaper('letter', 'portrait');
        
        return $pdf->stream("Reporte_Bimestral_{$bimestre}_{$proyecto->estudiante->numero_control}.pdf");
    }

    /**
     * Generar Reporte Final (ITA-VI-SS-FO-03)
     */
    public function reporteFinal($proyectoId)
    {
        $proyecto = ProyectoServicioSocial::with(['estudiante', 'dependencia'])->findOrFail($proyectoId);
        
        if (!Auth::user()->canAccessProject($proyecto)) {
            abort(403, 'No tienes permisos para acceder a este documento.');
        }

        $data = [
            'proyecto' => $proyecto,
            'estudiante' => $proyecto->estudiante,
            'dependencia' => $proyecto->dependencia,
            'fechaGeneracion' => now()->format('d/m/Y'),
            'codigoFormulario' => 'ITA-VI-SS-FO-03',
            'version' => '1.0',
            'fechaVigencia' => '01/08/2023'
        ];

        $pdf = Pdf::loadView('pdf.reporte-final', $data);
        $pdf->setPaper('letter', 'portrait');
        
        return $pdf->stream("Reporte_Final_{$proyecto->estudiante->numero_control}.pdf");
    }

    /**
     * Calcular período del bimestre
     */
    private function calcularPeriodoBimestre($fechaInicio, $bimestre)
    {
        $inicio = Carbon::parse($fechaInicio);
        $inicioReporte = $inicio->copy()->addMonths(($bimestre - 1) * 2);
        $finReporte = $inicioReporte->copy()->addMonths(2)->subDay();
        
        return [
            'inicio' => $inicioReporte->format('d/m/Y'),
            'fin' => $finReporte->format('d/m/Y')
        ];
    }

    /**
     * Convertir número de mes a español
     */
    private function mesEnEspanol($mes)
    {
        $meses = [
            1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
        ];
        
        return $meses[$mes] ?? '';
    }
}