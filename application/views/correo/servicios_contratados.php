<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Servicios contratados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>

    <h2>¡Gracias por contratar con ExpressService!</h2>

    <p>Hola <strong><?= htmlspecialchars($usuario['nombre']) ?></strong>,</p>

    <p>Te compartimos el resumen de los servicios contratados:</p>

    <table>
        <thead>
            <tr>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            foreach ($contrataciones as $c): 
                $fecha = date('Y-m-d', strtotime($c['fecha_hora']));
                $hora_inicio = date('H:i', strtotime($c['hora_inicio']));
                $hora_fin = date('H:i', strtotime($c['hora_fin'] . ' +1 hour'));
                $monto = floatval($c['monto']);
                $total += $monto;
            ?>
                <tr>
                    <td><?= htmlspecialchars($c['titulo']) ?></td>
                    <td><?= $fecha ?></td>
                    <td><?= $hora_inicio ?></td>
                    <td><?= $hora_fin ?></td>
                    <td>$<?= number_format($monto, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td><strong>$<?= number_format($total, 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <p>Si tienes dudas o necesitas ayuda, no dudes en contactarnos.</p>
    <p>— El equipo de ExpressService</p>

</body>
</html>
