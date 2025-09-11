<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Terminación - Servicio Social</title>
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
            <td class="encabezado-der">{{ $proyecto->numero_oficio ?? 'DSC/' . date('Y') . '/' . str_pad($proyecto->id, 4, '0', STR_PAD_LEFT) . '-T' }}</td>
        </tr>
        <tr>
            <td class="encabezado-izq">ASUNTO:</td>
            <td class="encabezado-der">CARTA DE TERMINACIÓN.</td>
        </tr>
    </table>
    
    <!-- Destinatario -->
    <div class="destinatario">
        <strong>DR. JOSÉ LUIS GIL VÁZQUEZ</strong><br><br>
        <strong>DIRECTOR DEL INSTITUTO TECNOLÓGICO DE AGUASCALIENTES</strong><br><br>
        <strong>AT'N: M. C. FRANCISCO SÁNCHEZ MARES</strong><br><br>
        <strong>JEFE DEL DEPTO. DE GESTIÓN TECNOLÓGICA Y VINCULACIÓN</strong>
    </div>
    
    <!-- Contenido de la carta -->
    <div class="contenido">
        <p>Por medio de la presente me permito informarle que la <strong>{{ $estudiante->sexo === 'F' ? 'C.' : 'C.' }} {{ strtoupper($estudiante->nombre_completo) }}</strong>, estudiante del programa educativo de <strong>{{ strtoupper($estudiante->carrera) }}</strong>, con número de control <strong>{{ $estudiante->numero_control }}</strong>, ha <strong>CONCLUIDO SATISFACTORIAMENTE</strong> su Servicio Social en <strong>{{ strtoupper($dependencia->nombre) }}</strong>, donde realizó las siguientes actividades: <strong>{{ strtoupper($proyecto->actividades_principales ?: $proyecto->actividades_realizar) }}</strong>, donde cubrió un total de <strong>{{ $proyecto->horas_acumuladas }}</strong> horas iniciando el <strong>{{ $proyecto->fecha_inicio->format('d') }} de {{ $this->mesEnEspanol($proyecto->fecha_inicio->format('n')) }} de {{ $proyecto->fecha_inicio->format('Y') }}</strong> y terminando el <strong>{{ $proyecto->fecha_terminacion->format('d') }} de {{ $this->mesEnEspanol($proyecto->fecha_terminacion->format('n')) }} de {{ $proyecto->fecha_terminacion->format('Y') }}</strong>.</p>
        
        <p>Se extiende la presente para los fines legales que a la interesada convengan, en la ciudad de Aguascalientes, Ags., a los <strong>{{ $proyecto->fecha_carta_terminacion ? $proyecto->fecha_carta_terminacion->format('d') : now()->format('d') }}</strong> días del mes de <strong>{{ $this->mesEnEspanol($proyecto->fecha_carta_terminacion ? $proyecto->fecha_carta_terminacion->format('n') : now()->format('n')) }}</strong> de <strong>{{ $proyecto->fecha_carta_terminacion ? $proyecto->fecha_carta_terminacion->format('Y') : now()->format('Y') }}</strong>.</p>
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