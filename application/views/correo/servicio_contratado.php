<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            color: #333;
        }
        .contenedor {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #1e90ff;
        }
        p {
            margin: 8px 0;
        }
        .detalle {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>¡Hola <?= htmlspecialchars($usuario['nombre']) ?>!</h2>

        <p>Gracias por contratar un servicio con <strong>ExpressService</strong>.</p>

        <div class="detalle">
            <p><strong>Servicio:</strong> <?= htmlspecialchars($servicio['id_servicio']) ?></p>
            <p><strong>Fecha y hora de inicio:</strong> <?= htmlspecialchars($servicio['fecha_hora']) ?></p>
            <p><strong>Duración (horas):</strong>
                <?php
                    $inicio = $servicio['hora_inicio'];
                    $fin = $servicio['hora_fin'];

                    // Si ambos son numéricos (por ejemplo: 8 y 10)
                    if (is_numeric($inicio) && is_numeric($fin)) {
                        $duracion = $fin - $inicio + 1;
                    } else {
                        // Convertir a DateTime si son cadenas como '08:00:00'
                        $horaInicio = new DateTime($inicio);
                        $horaFin = new DateTime($fin);
                        $horas = ($horaFin->format('H') - $horaInicio->format('H'));
                        $duracion = $horas + 1;
                    }

                    echo $duracion;
                ?>
            </p>
            <p><strong>Total a pagar:</strong> $<?= number_format($servicio['monto'], 2) ?> MXN</p>
        </div>

        <p>Si tienes alguna duda o deseas cancelar, comunícate con nosotros.</p>

        <p>Saludos,<br><strong>Equipo ExpressService</strong></p>
    </div>
</body>
</html>
