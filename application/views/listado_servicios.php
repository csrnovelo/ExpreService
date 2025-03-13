<!-- Container (Services Section) -->
<div id="services" class="container" style="margin-top: 40px;">
    <div class="row justify-content-center">
        <?php if(isset($servicios) && !empty($servicios)): ?>
            <?php foreach($servicios as $servicio): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                    <div class="card h-100">
                        <div class="card-header"><?php echo $servicio->categoria; ?></div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $servicio->titulo; ?></h4>
                            <p class="card-text"><?php echo LimpiaCadena($servicio->descripcion); ?></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Prestador: <?php echo LimpiaCadena($servicio->nombre_usuario . ' ' . $servicio->apellido_paterno); ?>
                                </small>
                            </p>
                            <p class="card-text">
                                <strong>Precio por hora: $<?php echo number_format($servicio->precio_hora, 2); ?></strong>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary" 
                                    onclick="verDetalleServicio(<?php echo $servicio->Id; ?>)" 
                                    style="background-color: #5271ff; border: none;">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <h3>No hay servicios disponibles en este momento.</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function verDetalleServicio(id) {
    console.log('Ver servicio:', id);
}
</script>