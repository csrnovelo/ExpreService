<div class="container mt-4" style="margin-bottom: 15px; padding-top: 60px;">
    <div class="row" id="servicio-detalle">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 mb-4">
                <?php if ($servicio): ?>
                    <ul class="list-unstyled">
                        <li><h2> <?= LimpiaCadena($servicio['titulo']) ?></h2></li>
                        <li><strong>Descripción:</strong> <?= LimpiaCadena($servicio['servicio_descripcion']) ?></li>
                        <li><strong>Precio por Hora:</strong> <span class="badge bg-success">$<?= LimpiaCadena($servicio['precio_hora']) ?></span></li>
                        <li><strong>Creado en:</strong> <?= LimpiaCadena($servicio['servicio_fecha_creacion']) ?></li>
                        <li><strong>Categoría:</strong> <?= LimpiaCadena($servicio['categoria_descripcion']) ?></li>
                        <li><strong>Usuario:</strong> <?= LimpiaCadena($servicio['usuario_nombre'] . " " . $servicio['usuario_apellido']) ?></li>
                    </ul>
                    <input type="text" id="IdServicio" value="<?= $servicio['servicio_id'] ?>" hidden>
                    <input type="text" id="IdPrecioHora" value="<?= $servicio['precio_hora'] ?>" hidden>
                <?php else: ?>
                    <div class="alert alert-warning">No se encontró el servicio.</div>
                <?php endif; ?>
            </div>
            <div>
                <button class="btn btn-primary" onclick="contratar(<?php echo $servicio['servicio_id']; ?>)">Contratar</button>
                <button class="btn btn-secondary" onclick="contratarDespues(<?php echo $servicio['servicio_id']; ?>)">Contratar más tarde</button>
            </div>
        </div>

        <div class="col-md-6">
            <div id="idServicioCarrusel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach($carrusel as $key => $carr): ?>
                        <li data-target="#serviceCarousel" data-slide-to="<?php echo $key; ?>" 
                            class="<?php echo ($key == 0) ? 'active' : ''; ?>"></li>
                    <?php endforeach; ?>
                </ol>

                <div class="carousel-inner">
                    <?php foreach($carrusel as $key => $carr): ?>                        
                        <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>">
                            <img class="img-fluid"
                                src="<?php echo base_url('assets/images/carrusel_servicios/' . $carr['img']); ?>" 
                                alt="" 
                                style="max-height: 350px; max-height: 350px; object-fit: cover;">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#idServicioCarrusel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#idServicioCarrusel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

    </div>
    
    <div id="comentarios" class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Comentarios</h3>
        </div>

        <?php if ($this->session->userdata('logged_in')): ?>
            <div class="row mb-3" style="margin-bottom: 15px;">
                <div class="col-md-10 col-sm-12">
                    <input type="text" placeholder="Comentario..." class="form-control" id="nuevo-comentario">
                </div>
                <div class="col-md-2 col-sm-12">
                    <button class="btn btn-primary w-100" onclick="agregarComentario()">Añadir comentario</button>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">Debes iniciar sesión para poder comentar.</p>
        <?php endif; ?>


        <?php if (!empty($comentarios)): ?>
            <ul class="list-group">
                <?php foreach ($comentarios as $comentario): ?>
                    <li class="list-group-item">
                        <p><strong><?= LimpiaCadena($comentario['usuario_nombre'] . " " . $comentario['usuario_apellido']) ?>:</strong></p>
                        <p><?= nl2br(LimpiaCadena($comentario['comentario'])) ?></p>
                        <p><strong>Calificación:</strong> <span class="badge bg-warning text-dark"> <?= LimpiaCadena($comentario['calificacion']) ?>/5</span></p>
                        <p class="text-muted"><small>Fecha: <?= LimpiaCadena($comentario['comentario_fecha_creacion']) ?></small></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info">No hay comentarios para este servicio.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalHorario" tabindex="-1" aria-labelledby="modalHorarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div id="contenedorCalendario" class="container"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cerrarModal()">Cancelar</button>
                <button type="button" class="btn btn-primary" id="id_btn_guardar" onclick="pagarServicio()">Pagar</button>
            </div>
        </div>
    </div>
</div>


<script>
    var contratarD = false

    function abrirModal() {
        $('#modalHorario').modal('show');
    }

    function cerrarModal() {
        $('#modalHorario').modal('hide');
        contratarD = false
    }

    function agregarComentario(){
        const comentarioInput = document.getElementById('nuevo-comentario');
        const comentario = comentarioInput.value.trim();

        const usuarioId = document.getElementById('userId');

        if(usuarioId == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: 'Por favor, inicia sesión para comentar.'
            });
            return;
        }

        if(comentario.trim === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: 'Por favor, ingresa un comentario.'
            });
            return;
        }
    }

    function contratar(id_servicio){
        if(document.getElementById('userId') == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: 'Por favor, inicia sesión para contratar el servicio.'
            });
            return;
        } else{
            const id_usuario = document.getElementById('userId').value

            $.ajax({
                url: '<?= base_url("welcome/obtener_horario") ?>',
                type: 'GET',
                data: { id_servicio: id_servicio, id_usuario : id_usuario },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        abrirModalConHorario(response.data);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Aviso',
                            text: 'Error al obtener el horario del servicio: ' + response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'Error en la solicitud: ' + error
                    });
                }
            });
        }
    }

    function abrirModalConHorario(data) {
        const direcciones = data.direcciones;
        const horarios = data.horarios;

        const diasSemana = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sabado'];
        const contenedor = document.getElementById('contenedorCalendario');
        contenedor.innerHTML = '';

        const selectDireccionHTML = `
            <div class="mb-3">
                <label for="direccionSelect" class="form-label">Selecciona una dirección:</label>
                <select id="direccionSelect" class="form-select" required>
                    <option value="" disabled selected>-- Elige una dirección --</option>
                    ${direcciones.map(dir => `
                        <option value="${dir.id}">
                            ${dir.calle}, ${dir.colonia}, ${dir.titulo}
                        </option>
                    `).join('')}
                </select>
            </div>
        `;
        contenedor.innerHTML += selectDireccionHTML;

        const horariosPorDia = {};
        horarios.forEach(item => {
            const dia = item.dia;
            const horaInicio = parseInt(item.hora_inicio.split(':')[0]);
            const horaFin = parseInt(item.hora_fin.split(':')[0]);

            if (!horariosPorDia[dia]) {
                horariosPorDia[dia] = {
                    horas: [],
                    hora_fin: horaFin
                };
            }

            if (!horariosPorDia[dia].horas.includes(horaInicio)) {
                horariosPorDia[dia].horas.push(horaInicio);
            }

            if (horaFin > horariosPorDia[dia].hora_fin) {
                horariosPorDia[dia].hora_fin = horaFin;
            }
        });

        const hoy = new Date();
        const fechasProximas = {};

        for (let i = 1; i <= 14; i++) {
            const fecha = new Date();
            fecha.setDate(hoy.getDate() + i);
            const nombreDia = diasSemana[fecha.getDay()];
            if (horariosPorDia[nombreDia] && !fechasProximas[nombreDia]) {
                fechasProximas[nombreDia] = fecha.toISOString().split('T')[0];
            }
        }

        for (const [dia, info] of Object.entries(horariosPorDia)) {
            const fecha = fechasProximas[dia];
            if (!fecha) continue;

            const horasOrdenadas = info.horas.sort((a, b) => a - b);
            let horasHTML = '';

            horasOrdenadas.forEach(hora => {
                for (let h = hora; h < info.hora_fin + 1; h++) {
                    horasHTML += `
                        <button type="button" class="btn btn-outline-primary m-1 hora-btn" 
                            data-dia="${dia}" data-fecha="${fecha}" data-hora="${h}">
                            ${h}:00
                        </button>`;
                }
            });

            const bloqueHTML = `
                <div class="card my-2">
                    <div class="card-header">${dia} - ${fecha}</div>
                    <div class="card-body d-flex flex-wrap">${horasHTML}</div>
                </div>`;

            contenedor.innerHTML += bloqueHTML;
        }

        abrirModal(); // ✅ abrir el modal solo después de construir todo
    }

    function generarDiaHTML(dia, fecha, horas) {
        let horasHTML = '';
        horas.forEach(hora => {
            horasHTML += `
                <button type="button" class="btn btn-outline-primary m-1 hora-btn" 
                    data-dia="${dia}" data-fecha="${fecha}" data-hora="${hora}">
                    ${hora}:00
                </button>`;
        });

        return `
        <div class="card my-2">
            <div class="card-header">${dia} - ${fecha}</div>
            <div class="card-body d-flex flex-wrap">${horasHTML}</div>
        </div>`;
    }

    let primerClick = null;

    document.addEventListener('click', function(e) {
        if (!e.target.classList.contains('hora-btn')) return;

        const diaSeleccionado = e.target.getAttribute('data-dia');
        const botonesDia = Array.from(document.querySelectorAll(`.hora-btn[data-dia="${diaSeleccionado}"]`));
        const horaClic = parseInt(e.target.getAttribute('data-hora'));

        // Si es el primer clic, solo lo marcamos
        if (primerClick === null) {
            // Limpiar todos los botones
            document.querySelectorAll('.hora-btn').forEach(btn => {
                btn.classList.remove('active', 'btn-primary');
                btn.classList.add('btn-outline-primary');
            });

            e.target.classList.add('active', 'btn-primary');
            e.target.classList.remove('btn-outline-primary');
            primerClick = {
                dia: diaSeleccionado,
                hora: horaClic
            };
        } else {
            if (primerClick.dia !== diaSeleccionado) {
                // Si se hace clic en otro día, reiniciar
                document.querySelectorAll('.hora-btn').forEach(btn => {
                    btn.classList.remove('active', 'btn-primary');
                    btn.classList.add('btn-outline-primary');
                });
                e.target.classList.add('active', 'btn-primary');
                e.target.classList.remove('btn-outline-primary');
                primerClick = {
                    dia: diaSeleccionado,
                    hora: horaClic
                };
                return;
            }

            // Mismo día → seleccionar el rango
            const horaInicio = Math.min(primerClick.hora, horaClic);
            const horaFin = Math.max(primerClick.hora, horaClic);

            botonesDia.forEach(btn => {
                const horaBtn = parseInt(btn.getAttribute('data-hora'));
                if (horaBtn >= horaInicio && horaBtn <= horaFin) {
                    btn.classList.add('active', 'btn-primary');
                    btn.classList.remove('btn-outline-primary');
                } else {
                    btn.classList.remove('active', 'btn-primary');
                    btn.classList.add('btn-outline-primary');
                }
            });

            // Reiniciar para permitir nueva selección
            primerClick = null;
        }
    });

    function pagarServicio() {
        const botonesSeleccionados = document.querySelectorAll('.hora-btn.active');

        const idServicio = document.getElementById('IdServicio').value;
        const precioHora = document.getElementById('IdPrecioHora').value;
        const idUsuario = document.getElementById('userId').value;
        const correo_usuario = document.getElementById('correo_usuario').value;
        const direccionSelect = document.getElementById('direccionSelect');

        if (!direccionSelect) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se ha seleccionado una dirección.'
            });
            return;
        }
        const id_direccion = direccionSelect.value;

        const fechasSeleccionadas = [];
        botonesSeleccionados.forEach(btn => {
            const fecha = btn.getAttribute('data-fecha');
            const hora = btn.getAttribute('data-hora');
            fechasSeleccionadas.push({ fecha: fecha, hora: hora });
        });


        if(contratarD === false){
            $.ajax({
                url: '<?= base_url("welcome/contratar_servicio") ?>',
                type: 'POST',
                data: {
                    id_servicio: idServicio,
                    id_usuario: idUsuario,
                    id_direccion: id_direccion,
                    precio_hora: precioHora,
                    fechas: fechasSeleccionadas,
                    correo_usuario: correo_usuario,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message
                        });
                        cerrarModal();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la solicitud: ' + error
                    });
                }
            });
        }else{
                        $.ajax({
                url: '<?= base_url("welcome/contratar_servicio_despues") ?>',
                type: 'POST',
                data: {
                    id_servicio: idServicio,
                    id_usuario: idUsuario,
                    id_direccion: id_direccion,
                    precio_hora: precioHora,
                    fechas: fechasSeleccionadas,
                    correo_usuario: correo_usuario,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: reponse.message
                        });
                        cerrarModal();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la solicitud: ' + error
                    });
                }
            });
        }
    }

    function contratarDespues(id_servicio){
        contratarD = true
        if(document.getElementById('userId') == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: 'Por favor, inicia sesión para contratar el servicio.'
            });
            return;
        } else{
            const id_usuario = document.getElementById('userId').value

            $.ajax({
                url: '<?= base_url("welcome/obtener_horario") ?>',
                type: 'GET',
                data: { id_servicio: id_servicio, id_usuario : id_usuario },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        abrirModalConHorario(response.data);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Aviso',
                            text: 'Error al obtener el horario del servicio: ' + response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'Error en la solicitud: ' + error
                    });
                }
            });
        }
    }
</script>

<style>
    .carousel-item img {
        max-height: 350px;
        object-fit: cover;
    }

</style>