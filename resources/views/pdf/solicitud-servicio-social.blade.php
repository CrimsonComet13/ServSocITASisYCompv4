<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Servicio Social - ITA-VI-SS-FO-01</title>
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
        
        .seccion-titulo {
            background-color: #000;
            color: #fff;
            padding: 5px;
            font-weight: bold;
            font-size: 11pt;
            margin: 15px 0 10px 0;
            text-transform: uppercase;
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
        
        .checkbox-grupo {
            margin: 10px 0;
        }
        
        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 5px;
            text-align: center;
            line-height: 10px;
            font-size: 8pt;
        }
        
        .checkbox.checked {
            background-color: #000;
            color: #fff;
        }
        
        .actividades-area {
            border: 1px solid #000;
            min-height: 80px;
            padding: 5px;
            margin: 10px 0;
        }
        
        .tipos-proyecto {
            display: table;
            width: 100%;
            margin: 15px 0;
        }
        
        .tipos-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }
        
        .tipo-item {
            margin: 5px 0;
        }
        
        .footer-form {
            position: fixed;
            bottom: 1cm;
            left: 0;
            right: 0;
            font-size: 8pt;
            color: #000;
            text-align: left;
            border-collapse: collapse;
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
            <div style="margin-top: 15px;"><strong>SOLICITUD DE SERVICIO SOCIAL</strong></div>
        </div>
        <div class="header-right">
            <div style="border: 1px solid #000; padding: 5px; margin-bottom: 5px;">
                <strong>Código:</strong> {{ $codigoFormulario }}<br>
                <strong>Revisión:</strong> {{ $version }}<br>
                <strong>Emisión:</strong> {{ $fechaVigencia }}
            </div>
        </div>
    </div>
    
    <!-- Sección: Datos Personales -->
    <div class="seccion-titulo">DATOS PERSONALES</div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">APELLIDO PATERNO</span>
        <span class="campo-linea">{{ strtoupper($estudiante->apellido_paterno) }}</span>
        <span class="campo-etiqueta">APELLIDO MATERNO</span>
        <span class="campo-linea">{{ strtoupper($estudiante->apellido_materno) }}</span>
        <span class="campo-etiqueta">NOMBRE(S)</span>
        <span class="campo-linea">{{ strtoupper($estudiante->nombres) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Sexo:</span>
        <span class="campo-linea">{{ $estudiante->sexo }}</span>
        <span class="campo-etiqueta">Teléfono:</span>
        <span class="campo-linea">{{ $estudiante->telefono }}</span>
        <span class="campo-etiqueta">Correo electrónico:</span>
        <span class="campo-linea">{{ $estudiante->correo_electronico }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Domicilio:</span>
        <span class="campo-linea-larga">{{ $estudiante->domicilio }}</span>
    </div>
    
    <!-- Sección: Escolaridad -->
    <div class="seccion-titulo">ESCOLARIDAD</div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">No. de Control:</span>
        <span class="campo-linea">{{ $estudiante->numero_control }}</span>
        <span class="campo-etiqueta">Carrera:</span>
        <span class="campo-linea">{{ $estudiante->carrera }}</span>
        <span class="campo-etiqueta">Periodo:</span>
        <span class="campo-linea">{{ $estudiante->periodo }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Semestre:</span>
        <span class="campo-linea">{{ $estudiante->semestre }}</span>
        <span class="campo-etiqueta">No. de Créditos:</span>
        <span class="campo-linea">{{ $estudiante->creditos }}</span>
    </div>
    
    <!-- Sección: Datos del Programa -->
    <div class="seccion-titulo">DATOS DEL PROGRAMA</div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Dependencia Oficial:</span>
        <span class="campo-linea-larga">{{ strtoupper($dependencia->nombre) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Domicilio de la Dependencia:</span>
        <span class="campo-linea-larga">{{ $dependencia->domicilio }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Titular de la Dependencia:</span>
        <span class="campo-linea-larga">{{ strtoupper($dependencia->titular) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Cargo del Titular de la Dependencia</span>
        <span class="campo-linea-larga">{{ strtoupper($dependencia->cargo_titular) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Nombre del Responsable del Proyecto:</span>
        <span class="campo-linea-larga">{{ strtoupper($dependencia->responsable) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Cargo del Responsable del Proyecto:</span>
        <span class="campo-linea-larga">{{ strtoupper($dependencia->cargo_responsable) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Nombre del Programa:</span>
        <span class="campo-linea-larga">{{ strtoupper($proyecto->nombre_programa) }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Modalidad:</span>
        <span class="checkbox {{ $proyecto->modalidad === 'Externa' ? 'checked' : '' }}">{{ $proyecto->modalidad === 'Externa' ? 'X' : '' }}</span> Externa
        <span class="checkbox {{ $proyecto->modalidad === 'Interna' ? 'checked' : '' }}">{{ $proyecto->modalidad === 'Interna' ? 'X' : '' }}</span> Interna
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Fecha de Inicio:</span>
        <span class="campo-linea">{{ $proyecto->fecha_inicio->format('d/m/Y') }}</span>
        <span class="campo-etiqueta">Fecha de Terminación:</span>
        <span class="campo-linea">{{ $proyecto->fecha_terminacion->format('d/m/Y') }}</span>
    </div>
    
    <div class="campo-fila">
        <span class="campo-etiqueta">Actividades a realizar:</span>
        <div class="actividades-area">{{ $proyecto->actividades_realizar }}</div>
    </div>
    
    <!-- Tipo de Proyecto -->
    <div class="seccion-titulo">TIPO DE PROYECTO:</div>
    
    <div class="tipos-proyecto">
        <div class="tipos-col">
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Educación para adultos' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Educación para adultos' ? 'X' : '' }}</span> Educación para adultos
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Actividades deportivas' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Actividades deportivas' ? 'X' : '' }}</span> Actividades deportivas
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Actividades cívicas' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Actividades cívicas' ? 'X' : '' }}</span> Actividades cívicas
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Apoyo a la salud' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Apoyo a la salud' ? 'X' : '' }}</span> Apoyo a la salud
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Otros' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Otros' ? 'X' : '' }}</span> Otros
            </div>
        </div>
        <div class="tipos-col">
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Desarrollo de comunidad' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Desarrollo de comunidad' ? 'X' : '' }}</span> Desarrollo de comunidad
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Actividades culturales' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Actividades culturales' ? 'X' : '' }}</span> Actividades culturales
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Desarrollo Sustentable' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Desarrollo Sustentable' ? 'X' : '' }}</span> Desarrollo Sustentable
            </div>
            <div class="tipo-item">
                <span class="checkbox {{ $proyecto->tipo_proyecto === 'Medio ambiente' ? 'checked' : '' }}">{{ $proyecto->tipo_proyecto === 'Medio ambiente' ? 'X' : '' }}</span> Medio ambiente
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer-form">
        <table class="footer-table">
            <tr>
                <td><strong>Elaborado por:</strong> Titular del Departamento de Gestión Tecnológica y Vinculación</td>
                <td>Página 1 de 2</td>
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