<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Final - ITA-VI-SS-FO-03</title>
    <style>
        @page {
            margin: 1.5cm;
            font-family: Arial, sans-serif;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
        }
        
        .header-form {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .header-left {
            display: table-cell;
            width: 15%;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        
        .header-center {
            display: table-cell;
            width: 85%;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        
        .logo-placeholder {
            width: 60px;
            height: 60px;
            border: 1px dashed #666;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 8pt;
            color: #666;
        }
        
        .titulo-formulario {
            font-size: 14pt;
            font-weight: bold;
            margin: 2px 0;
            text-transform: uppercase;
        }
        
        .subtitulo-formulario {
            font-size: 12pt;
            font-weight: bold;
            margin: 2px 0;
            text-transform: uppercase;
        }
        
        .datos-estudiante {
            margin: 20px 0;
        }
        
        .campo-fila {
            margin-bottom: 8px;
            display: table;
            width: 100%;
        }
        
        .campo-etiqueta {
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
            vertical-align: top;
        }
        
        .campo-linea {
            display: inline-block;
            border-bottom: 1px solid #000;
            min-width: 200px;
            padding-bottom: 2px;
            margin-right: 20px;
        }
        
        .campo-linea-larga {
            display: block;
            border-bottom: 1px solid #000;
            width: 100%;
            padding-bottom: 2px;
            margin-top: 5px;
        }
        
        .presentacion-box {
            border: 2px solid #000;
            min-height: 150px;
            padding: 10px;
            margin: 20px 0;
            text-align: center;
        }
        
        .presentacion-titulo {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        
        .actividades-tabla {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .actividades-tabla th,
        .actividades-tabla td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        
        .actividades-tabla th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        .actividades-tabla td {
            height: 30px;
        }
        
        .aprendizaje-tabla {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .aprendizaje-tabla th,
        .aprendizaje-tabla td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        
        .aprendizaje-tabla th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        .footer-form {
            position: fixed;
            bottom: 1cm;
            left: 0;
            right: 0;
            font-size: 8pt;
            color: #000;
            text-align: left;
        }
        
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .footer-table td {
            border: 1px solid #000;
            padding: 3px;
            font-size: 8pt;
        }
    </style>
</head>
<body>
    <!-- Header del formulario -->
    <div class="header-form">
        <div class="header-left">
            <div class="logo-placeholder">
                LOGO<br>ITA
            </div>
        </div>
        <div class="header-center">
            <div class="titulo-formulario">SUBDIRECCIÓN DE PLANEACIÓN Y VINCULACIÓN</div>
            <div class="subtitulo-formulario">DEPARTAMENTO DE GESTIÓN TECNOLÓGICA Y VINCULACIÓN</div>
            <div style="margin-top: 15px;"><strong>REPORTE FINAL</strong></div>
        </div>
    </div>
    
    <!-- Datos del estudiante -->
    <div class="datos-estudiante">
        <div class="campo-fila">
            <span class="campo-etiqueta">Nombre del estudiante:</span>
            <span class="campo-linea-larga">{{ strtoupper($estudiante->nombre_completo) }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Número de control:</span>
            <span class="campo-linea">{{ $estudiante->numero_control }}</span>
            <span class="campo-etiqueta">Carrera:</span>
            <span class="campo-linea">{{ $estudiante->carrera }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Dependencia:</span>
            <span class="campo-linea-larga">{{ $dependencia->nombre }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Nombre del Proyecto:</span>
            <span class="campo-linea-larga">{{ $proyecto->nombre_programa }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Nombre del Responsable del Proyecto:</span>
            <span class="campo-linea-larga">{{ $dependencia->responsable }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Municipio:</span>
            <span class="campo-linea">{{ $dependencia->municipio }}</span>
            <span class="campo-etiqueta">Estado:</span>
            <span class="campo-linea">{{ $dependencia->estado }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Fecha de entrega:</span>
            <span class="campo-linea">{{ $fechaGeneracion }}</span>
            <span class="campo-etiqueta">Periodo:</span>
            <span class="campo-linea">{{ $proyecto->fecha_inicio->format('d/m/Y') }} - {{ $proyecto->fecha_terminacion->format('d/m/Y') }}</span>
        </div>
    </div>
    
    <!-- Presentación de la Instancia -->
    <div class="presentacion-box">
        <div class="presentacion-titulo">
            Presentación de la Instancia donde se realizó el Servicio Social
        </div>
        <div style="text-align: justify; line-height: 1.5;">
            {{ $dependencia->nombre }} es una {{ strtolower($dependencia->cargo_titular) }} ubicada en {{ $dependencia->domicilio }}, {{ $dependencia->municipio }}, {{ $dependencia->estado }}. 
            La institución está dirigida por {{ $dependencia->titular }} y tiene como responsable del proyecto de servicio social a {{ $dependencia->responsable }}.
        </div>
    </div>
    
    <!-- Descripción de actividades realizadas -->
    <div style="margin: 20px 0;">
        <table class="actividades-tabla">
            <thead>
                <tr>
                    <th style="width: 8%;">No.</th>
                    <th style="width: 31%;">Descripción de la actividad realizada</th>
                    <th style="width: 31%;">Logros alcanzados</th>
                    <th style="width: 30%;">Evidencia de la actividad</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= 8; $i++)
                <tr>
                    <td style="text-align: center;">{{ $i }}</td>
                    <td>
                        @if($i == 1 && $proyecto->actividades_realizar)
                            {{ $proyecto->actividades_realizar }}
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    
    <!-- Aprendizaje, conocimientos aplicados y beneficio a la sociedad -->
    <div style="margin: 20px 0;">
        <div style="font-weight: bold; text-align: center; margin-bottom: 10px; text-transform: uppercase;">
            Aprendizaje, conocimientos aplicados y beneficio a la sociedad de la realización del Servicio Social
        </div>
        
        <table class="aprendizaje-tabla">
            <thead>
                <tr>
                    <th style="width: 33.33%;">Aprendizaje obtenido</th>
                    <th style="width: 33.33%;">Beneficio a la sociedad</th>
                    <th style="width: 33.33%;">Conocimientos aplicados</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="height: 100px;"></td>
                    <td style="height: 100px;"></td>
                    <td style="height: 100px;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Footer -->
    <div class="footer-form">
        <table class="footer-table">
            <tr>
                <td><strong>Elaborado por:</strong> Titular del Departamento de Gestión Tecnológica y Vinculación</td>
                <td>Página 1 de 4</td>
                <td><strong>Código:</strong> {{ $codigoFormulario }}</td>
            </tr>
            <tr>
                <td><strong>Revisado por:</strong> Subdirector de Planeación y Vinculación</td>
                <td><strong>Revisión:</strong> {{ $version }}</td>
                <td><strong>Emisión:</strong> {{ $fechaVigencia }}</td>
            </tr>
            <tr>
                <td><strong>Autorizado por:</strong> Director</td>
                <td colspan="2"><strong>Referencia a las normas:</strong> ISO 9001:2015 8.1</td>
            </tr>
        </table>
    </div>
</body>
</html>