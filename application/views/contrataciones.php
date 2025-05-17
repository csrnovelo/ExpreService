<div class="container py-5" style="margin-top: 50px;">
    <div class="row mb-4">
        <div class="col-lg-12 mx-auto text-center">
            <h1 class="display-4">Mis contrataciones</h1>
            <p class="lead">Aquí puedes gestionar tus servicios contratados.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
                    <h3 class="card-title mb-4">Mis Servicios por pagar</h3>
            <thead class="table-primary">
                <tr>
                    <th>Servicio</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                    <th>Precio/hora</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaServiciosNoPagados">
                <?php 
                $totalGeneral = 0; // Inicializamos el total general
                
                if (isset($contrataciones_por_pagar) && !empty($contrataciones_por_pagar)) : ?>
                    <?php foreach ($contrataciones_por_pagar as $contraPNO): ?>
                        <?php
                        // Procesamiento de datos
                        $fecha = date('Y-m-d', strtotime($contraPNO['fecha_hora']));
                        $hora_inicio = date('H:i', strtotime($contraPNO['hora_inicio']));
                        
                        // Calcular hora fin +1 para visualización
                        $hora_fin_original = new DateTime($contraPNO['hora_fin']);
                        $hora_fin_original->modify('+1 hour');
                        $hora_fin = $hora_fin_original->format('H:i');
                        
                        // Cálculo de horas y subtotal
                        $datetime1 = new DateTime($contraPNO['hora_inicio']);
                        $datetime2 = new DateTime($contraPNO['hora_fin']);
                        $interval = $datetime1->diff($datetime2);
                        $horas = $interval->h + 1;
                        $subtotal = $horas * $contraPNO['monto'];
                        $totalGeneral += $subtotal; // Sumamos al total general
                        
                        $precio_hora = $contraPNO['monto'];
                        ?>
                        <tr data-id="<?= $contraPNO['Id'] ?>">
                            <td><?= htmlspecialchars($contraPNO['servicio'] ?? '') ?></td>
                            <td><?= htmlspecialchars($contraPNO['lugar'] ?? '') ?></td>
                            <td><?= $fecha ?></td>
                            <td><?= $hora_inicio ?></td>
                            <td><?= $hora_fin ?></td>
                            <td>$<?= number_format($precio_hora, 2) ?></td>
                            <td>$<?= number_format($subtotal, 2) ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="editarServicio(<?= $contraPNO['Id'] ?>)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="eliminarServicio(<?= $contraPNO['Id'] ?>)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No tienes servicios por pagar</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-end fw-bold">Total General:</td>
                    <td class="fw-bold">$<?= number_format($totalGeneral, 2) ?></td>
                    <td>
                        <button class="btn btn-success" onclick="pagarTodo()" <?= empty($contrataciones_por_pagar) ? 'disabled' : '' ?>>
                            <i class="bi bi-credit-card"></i> Pagar Todo
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Mis Servicios contratados</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Servicio</th>
                                    <th>Lugar</th>
                                    <th>Fecha contratada</th>
                                    <th>Hora inicio</th>
                                    <th>Hora fin</th>
                                    <th>Precio por hora</th>
                                    <th>Total</th>
                                    <!-- <th>Acciones</th> -->
                                </tr>
                            </thead>
                            <tbody id="tablaServicios">
                                <?php if (isset($contrataciones_pagadas) && !empty($contrataciones_pagadas)) : ?>
                                    <?php foreach ($contrataciones_pagadas as $contraP): ?>
                                        <?php
                                        // Procesamiento de datos
                                        $fecha = date('Y-m-d', strtotime($contraP['fecha_hora']));
                                        $hora_inicio = date('H:i', strtotime($contraP['hora_inicio']));
                                        $hora_fin = date('H:i', strtotime($contraP['hora_fin']));
                                        
                                        // Calcular horas y total
                                        $datetime1 = new DateTime($contraP['hora_inicio']);
                                        $datetime2 = new DateTime($contraP['hora_fin']);
                                        $interval = $datetime1->diff($datetime2);
                                        $horas = $interval->h + 1; // +1 porque incluye ambas horas
                                        $total = $horas * $contraP['monto'];

                                        // Calculamos hora_fin + 1 hora (solo para visualización)
                                        $hora_fin_original = new DateTime($contraP['hora_fin']);
                                        $hora_fin_original->modify('+1 hour');
                                        $hora_fin = $hora_fin_original->format('H:i');

                                        // Calcular diferencia de horas para el precio
                                        $hora_inicio_original = new DateTime($contraP['hora_inicio']);
                                        $hora_fin_para_calculo = new DateTime($contraP['hora_fin']);
                                        $intervalo = $hora_inicio_original->diff($hora_fin_para_calculo);

                                        $horas_totales = $intervalo->h + 1; 
                                        $precio_hora = ($horas_totales > 0) ? ($contraP['monto'] / $horas_totales) : 0;
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($contraP['servicio'] ?? '') ?></td>
                                            <td><?= htmlspecialchars($contraP['lugar'] ?? '') ?></td>
                                            <td><?= $fecha ?></td>
                                            <td><?= $hora_inicio ?></td>
                                            <td><?= $hora_fin ?></td>
                                            <td>$<?= $precio_hora ?></td>
                                            <td>$<?= number_format($contraP['monto'] ?? 0, 2) ?></td>
                                            <!-- <td>
                                                <button class="btn btn-sm btn-primary" onclick="editarServicio(<?= $contraP['Id'] ?>)">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminarServicio(<?= $contraP['Id'] ?>)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No tienes servicios registrados</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Mis Servicios finalizados</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Servicio</th>
                                    <th>Lugar</th>
                                    <th>Fecha contratada</th>
                                    <th>Hora inicio</th>
                                    <th>Hora fin</th>
                                    <th>Monto</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="tablaServiciosNoPagados">
                                <?php if (isset($contrataciones_finalizadas) && !empty($contrataciones_finalizadas)) : ?>
                                    <?php foreach ($contrataciones_finalizadas as $contraPFin): ?>
                                        <?php
                                        // Procesamiento de datos
                                        $fecha = date('Y-m-d', strtotime($contraPFin['fecha_hora']));
                                        $hora_inicio = date('H:i', strtotime($contraPFin['hora_inicio']));
                                        $hora_fin = date('H:i', strtotime($contraPFin['hora_fin']));
                                        
                                        // Calcular horas y total
                                        $datetime1 = new DateTime($contraPFin['hora_inicio']);
                                        $datetime2 = new DateTime($contraPFin['hora_fin']);
                                        $interval = $datetime1->diff($datetime2);
                                        $horas = $interval->h + 1; // +1 porque incluye ambas horas
                                        $total = $horas * $contraPFin['monto'];

                                        // Calculamos hora_fin + 1 hora (solo para visualización)
                                        $hora_fin_original = new DateTime($contraPFin['hora_fin']);
                                        $hora_fin_original->modify('+1 hour');
                                        $hora_fin = $hora_fin_original->format('H:i');

                                        // Calcular diferencia de horas para el precio
                                        $hora_inicio_original = new DateTime($contraPFin['hora_inicio']);
                                        $hora_fin_para_calculo = new DateTime($contraPFin['hora_fin']);
                                        $intervalo = $hora_inicio_original->diff($hora_fin_para_calculo);

                                        $horas_totales = $intervalo->h + 1; 
                                        $precio_hora = ($horas_totales > 0) ? ($contraPFin['monto'] / $horas_totales) : 0;
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($contraPFin['servicio'] ?? '') ?></td>
                                            <td><?= htmlspecialchars($contraPFin['lugar'] ?? '') ?></td>
                                            <td><?= $fecha ?></td>
                                            <td><?= $hora_inicio ?></td>
                                            <td><?= $hora_fin ?></td>
                                            <td>$<?= $precio_hora ?></td>
                                            <td>$<?= number_format($contraPFin['monto'] ?? 0, 2) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No tienes servicios finalizados</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function pagarTodo() {
        let ids = [];
        const correo_usuario = document.getElementById('correo_usuario').value;
        const idUsuario = document.getElementById('userId').value;

        $('#tablaServiciosNoPagados tr').each(function () {
            const idAttr = $(this).data('id');
            if (idAttr) {
                ids.push(idAttr);
            }
        });

        if (ids.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'No hay servicios para pagar',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        Swal.fire({
            title: '¿Confirmas el pago de todos los servicios?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, pagar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("welcome/pagarTodo") ?>',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ 
                        ids: ids, 
                        correo_usuario: correo_usuario, 
                        idUsuario: idUsuario 
                    }),
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pago realizado con éxito',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al procesar el pago.'
                        });
                    }
                });
            }
        });
    }
</script>

