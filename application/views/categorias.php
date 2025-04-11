<div class="container-fluid" style="padding-top: 60px;">
    <div class="container mt-4">
        <h2> <?= LimpiaCadena($nombre_servicio->descripcion) ?></h2>
    </div>

    <div id="servicios" class="container mt-4">
        <div class="row g-4 justify-content-center">
            <?php if(isset($lista_servicios) && !empty($lista_servicios)): ?>
                <?php foreach($lista_servicios as $servicio): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12" style="margin-top: 10px;">
                        <div class="card h-100 shadow-sm" style="min-height: 400px; max-height: 400px; display: flex; flex-direction: column; justify-content: space-between; cursor: pointer; border: 1px solid #ddd; transition: box-shadow 0.3s;" onclick="verDetalleServicio(<?php echo $servicio->Id; ?>)">
                            <img src="<?php echo base_url('assets/images/imagenes_servicios/' . $servicio->img); ?>" 
                                class="card-img-top" 
                                alt="Imagen de <?php echo LimpiaCadena($servicio->titulo); ?>" 
                                style="height: 150px; object-fit: cover; border-bottom: 1px solid #ddd;">
                            <div class="card-body p-3" style="flex-grow: 1; padding: 20px;">
                                <h4 class="card-title mb-2"><?php echo LimpiaCadena($servicio->titulo); ?></h4>
                                <p class="card-text mb-2"><?php echo LimpiaCadena($servicio->descripcion); ?></p>
                                <p class="card-text text-muted mb-2">
                                    <i class="fas fa-user me-1"></i>
                                    <?php echo LimpiaCadena($servicio->nombre_usuario . ' ' . $servicio->usuario_apellido); ?>
                                </p>
                                <p class="card-text fw-bold text-primary mb-2">
                                    $<?php echo number_format($servicio->precio_hora, 2); ?> / hora
                                </p>
                                <!-- <p class="card-text mb-2"><?php echo "calificación: ".$servicio->promedio_calificacion; ?></p> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <h5>No hay servicios disponibles en este momento.</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    verDetalleServicio = (id) => 
    {
        window.location.href = '<?php echo base_url('welcome/detalle_servicio/'); ?>' + id;
    }

    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
    });
        card.addEventListener('mouseout', () => {
            card.style.boxShadow = 'none';
        });
    });
</script>