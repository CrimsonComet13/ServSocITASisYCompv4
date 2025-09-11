<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Bimestral - ITA-VI-SS-FO-02</title>
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
            width: 70%;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        
        .header-right {
            display: table-cell;
            width: 15%;
            vertical-align: top;
            padding: 5px;
            border: 1px solid #000;
            font-size: 8pt;
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
        
        .reporte-numero {
            position: absolute;
            top: 20px;
            right: 20px;
            border: 2px solid #000;
            padding: 5px 10px;
            font-weight: bold;
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
            height: 25px;
        }
        
        .evaluacion-seccion {
            margin: 30px 0;
            page-break-before: always;
        }
        
        .evaluacion-titulo {
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        
        .evaluacion-instrucciones {
            font-size: 9pt;
            margin-bottom: 15px;
        }
        
        .bimestre-seleccion {
            margin: 15px 0;
            text-align: center;
        }
        
        .bimestre-checkbox {
            display: inline-block;
            border: 1px solid #000;
            padding: 5px 10px;
            margin: 0 10px;
            font-weight: bold;
        }
        
        .bimestre-checkbox.selected {
            background-color: #000;
            color: #fff;
        }
        
        .evaluacion-tabla {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 9pt;
        }
        
        .evaluacion-tabla th,
        .evaluacion-tabla td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }
        
        .evaluacion-tabla th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        .evaluacion-checkbox {
            width: 15px;
            height: 15px;
            border: 1px solid #000;
            text-align: center;
            line-height: 13px;
        }
        
        .firmas-seccion {
            margin-top: 40px;
            display: table;
            width: 100%;
        }
        
        .firma-columna {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }
        
        .firma-box {
            border: 1px solid #000;
            min-height: 60px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .observaciones-box {
            border: 1px solid #000;
            min-height: 60px;
            padding: 5px;
            margin: 10px 0;
        }
        
        .nota-importante {
            margin-top: 30px;
            font-size: 9pt;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
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
    <!-- Número de reporte -->
    <div class="reporte-numero">
        REPORTE No. {{ $bimestre }}
    </div>
    
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
            <div style="margin-top: 15px;"><strong>REPORTE BIMESTRAL</strong></div>
        </div>
        <div class="header-right">
            <strong>Código:</strong> {{ $codigoFormulario }}<br>
            <strong>Revisión:</strong> {{ $version }}<br>
            <strong>Emisión:</strong> {{ $fechaVigencia }}<br>
            <strong>Página:</strong> 1 de 4
        </div>
    </div>
    
    <!-- Datos del estudiante -->
    <div class="datos-estudiante">
        <div class="campo-fila">
            <span class="campo-etiqueta">Nombre:</span>
            <div style="display: table; width: 100%;">
                <div style="display: table-cell; width: 30%; padding-right: 10px;">
                    <div style="text-align: center; font-size: 9pt; margin-bottom: 3px;">Apellido Paterno</div>
                    <div class="campo-linea" style="width: 100%; text-align: center;">{{ strtoupper($estudiante->apellido_paterno) }}</div>
                </div>
                <div style="display: table-cell; width: 30%; padding-right: 10px;">
                    <div style="text-align: center; font-size: 9pt; margin-bottom: 3px;">Apellido Materno</div>
                    <div class="campo-linea" style="width: 100%; text-align: center;">{{ strtoupper($estudiante->apellido_materno) }}</div>
                </div>
                <div style="display: table-cell; width: 40%;">
                    <div style="text-align: center; font-size: 9pt; margin-bottom: 3px;">Nombre (s)</div>
                    <div class="campo-linea" style="width: 100%; text-align: center;">{{ strtoupper($estudiante->nombres) }}</div>
                </div>
            </div>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Carrera:</span>
            <span class="campo-linea">{{ $estudiante->carrera }}</span>
            <span class="campo-etiqueta">No. De Control:</span>
            <span class="campo-linea">{{ $estudiante->numero_control }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Periodo Reportado:</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Del día:</span>
            <span class="campo-linea">{{ $periodoReporte['inicio'] }}</span>
            <span class="campo-etiqueta">Al día</span>
            <span class="campo-linea">{{ $periodoReporte['fin'] }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Dependencia:</span>
            <span class="campo-linea-larga">{{ $dependencia->nombre }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Nombre del programa:</span>
            <span class="campo-linea-larga">{{ $proyecto->nombre_programa }}</span>
        </div>
        
        <div class="campo-fila">
            <span class="campo-etiqueta">Total de horas de este reporte:</span>
            <span class="campo-linea">{{ number_format($proyecto->horas_totales / 3) }}</span>
            <span class="campo-etiqueta">Total de horas acumuladas:</span>
            <span class="campo-linea">{{ number_format($proyecto->horas_acumuladas) }}</span>
        </div>
    </div>
    
    <!-- Actividades realizadas -->
    <div style="margin: 20px 0;">
        <strong>Escribe las actividades que realizaste en el bimestre.</strong>
        
        <table class="actividades-tabla">
            <thead>
                <tr>
                    <th style="width: 8%;">No.</th>
                    <th style="width: 92%;">ACTIVIDADES REALIZADAS</th>
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
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    
    <!-- Sección de firmas -->
    <div class="firmas-seccion">
        <div class="firma-columna">
            <div class="firma-box">
                <strong>FIRMA DEL ESTUDIANTE</strong>
            </div>
        </div>
        <div class="firma-columna">
            <div class="firma-box">
                <div style="text-align: center;">
                    <strong>FIRMA</strong><br>
                    <strong>NOMBRE:</strong><br>
                    <strong>PUESTO:</strong><br>
                    <strong>SUPERVISOR DE PROYECTO</strong>
                </div>
            </div>
            <div style="text-align: center; font-weight: bold;">
                SELLO DE LA DEPENDENCIA
            </div>
        </div>
        <div class="firma-columna">
            <div class="firma-box">
                <div style="text-align: center;">
                    <strong>Vo. Bo. OFICINA<br>
                    SERVICIO SOCIAL<br>
                    DEL INSTITUTO TECNOLÓGICO<br>
                    DE AGUASCALIENTES</strong>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Nota importante -->
    <div class="nota-importante">
        NOTA: ESTE REPORTE DEBERÁ SER LLENADO, ENTREGADO CADA DOS MESES EN ORIGINAL Y COPIA, DENTRO DE LOS<br>
        PRIMEROS 5 DÍAS HÁBILES DE LA FECHA DE TÉRMINO DEL MISMO, DE LO CONTRARIO PROCEDERÁ SANCIÓN DE<br>
        ACUERDO AL REGLAMENTO VIGENTE (No es válido si presenta tachaduras, enmendaduras y/o correcciones).
    </div>
    
    <!-- PÁGINA 2: EVALUACIÓN DEL BIMESTRE -->
    <div class="evaluacion-seccion">
        <div class="evaluacion-titulo">
            EVALUACIÓN DEL BIMESTRE
        </div>
        
        <div class="evaluacion-instrucciones">
            a) Indique con una X el Bimestre a evaluar y el Nivel de desempeño del criterio.<br>
            b) Este formato deberá ser evaluado por el Responsable del Proyecto y por el Estudiante.<br>
            c) Nivel de desempeño: 0 Insuficiente, 1 Suficiente, 2 Bueno, 3 Notable y 4 Excelente
        </div>
        
        <div class="bimestre-seleccion">
            <span class="bimestre-checkbox {{ $bimestre == 1 ? 'selected' : '' }}">Bimestre 1</span>
            <span class="bimestre-checkbox {{ $bimestre == 2 ? 'selected' : '' }}">Bimestre 2</span>
            <span class="bimestre-checkbox {{ $bimestre == 3 ? 'selected' : '' }}">Bimestre 3</span>
        </div>
        
        <table class="evaluacion-tabla">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%;">No</th>
                    <th rowspan="2" style="width: 35%;">Criterios a evaluar</th>
                    <th rowspan="2" style="width: 15%;">Evaluador</th>
                    <th colspan="5" style="width: 25%;">Nivel de desempeño del criterio</th>
                    <th rowspan="2" style="width: 5%;">No.</th>
                    <th rowspan="2" style="width: 35%;">Criterios a evaluar</th>
                    <th colspan="5" style="width: 25%;">Nivel de desempeño del criterio</th>
                </tr>
                <tr>
                    <th>0</th><th>1</th><th>2</th><th>3</th><th>4</th>
                    <th>0</th><th>1</th><th>2</th><th>3</th><th>4</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2">1</td>
                    <td rowspan="2">Cumple en tiempo y forma con las actividades encomendadas alcanzando los objetivos</td>
                    <td>Responsable</td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td rowspan="2">1</td>
                    <td rowspan="2">¿Consideras importante la realización del Servicio Social?</td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                </tr>
                <tr>
                    <td>Estudiante</td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                    <td class="evaluacion-checkbox"></td>
                </tr>
                <!-- Más filas de evaluación aquí -->
            </tbody>
        </table>
        
        <div style="display: table; width: 100%; margin-top: 30px;">
            <div style="display: table-cell; width: 50%; padding-right: 20px;">
                <strong>Observaciones del responsable del proyecto:</strong>
                <div class="observaciones-box"></div>
            </div>
            <div style="display: table-cell; width: 50%; padding-left: 20px;">
                <strong>Observaciones del estudiante:</strong>
                <div class="observaciones-box"></div>
            </div>
        </div>
        
        <div style="display: table; width: 100%; margin-top: 30px;">
            <div style="display: table-cell; width: 50%; text-align: center;">
                <strong>RESPONSABLE DEL PROYECTO</strong>
            </div>
            <div style="display: table-cell; width: 50%; text-align: center;">
                <strong>ESTUDIANTE</strong>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer-form">
        <table class="footer-table">
            <tr>
                <td><strong>Elaborado por:</strong> Titular del Departamento de Gestión Tecnológica y Vinculación</td>
                <td>Página 3 de 4</td>
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