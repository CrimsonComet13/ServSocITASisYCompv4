<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Aceptación - Servicio Social</title>
    <style>
        @page {
            margin: 2.5cm 3cm;
            font-family: Arial, sans-serif;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 0;
        }
        
        .encabezado-tabla {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            margin-bottom: 30px;
        }
        
        .encabezado-tabla td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
        }
        
        .encabezado-izq {
            width: 25%;
            text-align: center;
            font-weight: bold;
        }
        
        .encabezado-der {
            width: 75%;
            font-weight: bold;
        }
        
        .fecha-lugar {
            text-align: right;
            margin-bottom: 30px;
            font-size: 12pt;
        }
        
        .destinatario {
            margin-bottom: 25px;
            font-weight: bold;
            line-height: 1.3;
        }
        
        .contenido {
            text-align: justify;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        
        .firma {
            margin-top: 80px;
            text-align: center;
        }
        
        .firma-texto {
            font-weight: bold;
            font-size: 12pt;
            line-height: 1.3;
        }
    </style>
</head>
<body>
    <!-- Encabezado según formato oficial -->
    <table class="encabezado-tabla">
        <tr>
            <td class="encabezado-izq">DEPARTAMENTO:</td>
            <td class="encabezado-der">{{ strtoupper($proyecto->departamento) }}</td>
        </tr>
        <tr>
            <td class="encabezado-izq">No. Oficio:</td>
            <td class="encabezado-der">{{ $proyecto->numero_oficio ?? 'DSC/' . date('Y') . '/' . str_pad($proyecto->id, 4, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td class="encabezado-izq">ASUNTO:</td>
            <td class="encabezado-der">CARTA DE ACEPTACIÓN</td>
        </tr>
    </table>
    
    <!-- Fecha y lugar -->
    <div class="fecha-lugar">
        Aguascalientes, Ags. {{ $proyecto->fecha_carta_aceptacion ? $proyecto->fecha_carta_aceptacion->format('d') . ' de ' . $this->mesEnEspanol($proyecto->fecha_carta_aceptacion->format('n')) . ' de ' . $proyecto->fecha_carta_aceptacion->format('Y') : $fechaGeneracion }}
    </div>
    
    <!-- Destinatario -->
    <div class="destinatario">
        <strong>{{ strtoupper($dependencia->titular) }}</strong><br><br>
        <strong>{{ strtoupper($dependencia->cargo_titular) }}</strong><br><br>
        <strong>{{ strtoupper($dependencia->nombre) }}</strong>
    </div>
    
    <!-- Contenido de la carta -->
    <div class="contenido">
        <p>Por medio de la presente me permito informarle que la <strong>{{ $estudiante->sexo === 'F' ? 'C.' : 'C.' }}{{ strtoupper($estudiante->nombre_completo) }}</strong>, estudiante de la especialidad de <strong>{{ strtoupper($estudiante->carrera) }}</strong>, con número de control <strong>{{ $estudiante->numero_control }}</strong>, fue <strong>aceptado{{ $estudiante->sexo === 'F' ? 'a' : '' }}</strong> para realizar su <strong>SERVICIO SOCIAL</strong> en la Oficina de <strong>{{ strtoupper($proyecto->nombre_programa) }}</strong> de esta Institución, donde cubrirá un total de <strong>{{ $proyecto->horas_totales }}</strong> horas a partir del {{ $proyecto->fecha_inicio->format('d') }} de {{ $this->mesEnEspanol($proyecto->fecha_inicio->format('n')) }} y terminando el {{ $proyecto->fecha_terminacion->format('d') }} de {{ $this->mesEnEspanol($proyecto->fecha_terminacion->format('n')) }} de {{ $proyecto->fecha_terminacion->format('Y') }}.</p>
        
        <p>Sin otro particular por el momento, aprovecho la ocasión para mandarle un cordial saludo.</p>
    </div>
    
    <!-- Firma -->
    <div class="firma">
        <div class="firma-texto">
            <strong>A T E N T A M E N T E</strong><br><br><br>
            <strong>{{ strtoupper($dependencia->responsable ?: 'RESPONSABLE DEL PROYECTO') }}</strong><br><br>
            <strong>RESPONSABLE DEL PROYECTO</strong><br><br>
            <strong>{{ strtoupper($dependencia->nombre) }}</strong>
        </div>
    </div>
</body>
</html>