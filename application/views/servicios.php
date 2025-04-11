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
                <?php else: ?>
                    <div class="alert alert-warning">No se encontró el servicio.</div>
                <?php endif; ?>
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

<script>
    function agregarComentario() 
    {
        const comentarioInput = document.getElementById('nuevo-comentario');
        const comentario = comentarioInput.value.trim();

        const usuarioId = document.getElementById('userId');

        if(usuarioId == null) {
            alert('Por favor, inicia sesión para comentar.');
            return;
        }

        if(comentario.trim === '') {
            alert('Por favor, ingresa un comentario.');
            return;
        }
    }
</script>

<style>
    .carousel-item img {
        max-height: 350px;
        object-fit: cover;
    }

</style>