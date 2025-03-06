<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div id="serviceCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach($carruseles as $key => $carrusel): ?>
                        <li data-target="#serviceCarousel" data-slide-to="<?php echo $key; ?>" 
                            class="<?php echo ($key == 0) ? 'active' : ''; ?>"></li>
                    <?php endforeach; ?>
                </ol>

                <div class="carousel-inner">
                    <?php foreach($carruseles as $key => $carrusel): ?>                        
                        <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>">
                            <img class="img-fluid"
                                src="<?php echo base_url('assets/images/' . $carrusel->nombre_ext); ?>" 
                                 alt="<?php echo $carrusel->descripcion; ?>" 
                                 style="width:100%; height: 500px; object-fit: cover;">
                            
                            <?php if(trim($carrusel->clave) === 'BUSQ'): ?>
                                <div class="carousel-caption" style="top: 50%; transform: translateY(-50%); bottom: auto;">
                                    <h2>¿Qué servicio estás buscando hoy?</h2>
                                    <p style="color: #fff; font-size: 18px;">Encuentra el servicio perfecto para tus necesidades</p>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="input-group" style="margin-top: 30px;">
                                                <input type="text" class="form-control input-lg" placeholder="Busca un servicio...">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-lg" type="button" style="background-color: #5271ff; color: white;">
                                                        <i class="glyphicon glyphicon-search"></i> Buscar
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#serviceCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#serviceCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .carousel-inner > .item > img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0,0,0,0.5);
        padding: 30px;
        border-radius: 10px;
    }

    .carousel .input-group {
        max-width: 600px;
        margin: 0 auto;
    }

    .carousel-caption h2 {
        margin-bottom: 20px;
        font-size: 36px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .carousel-indicators {
        bottom: 20px;
    }

    .carousel-control {
        width: 5%;
    }

    .input-group .form-control {
        height: 46px;
        border-radius: 4px 0 0 4px;
    }

    .input-group .btn {
        height: 46px;
        padding: 0 20px;
        border-radius: 0 4px 4px 0;
    }

    .carousel-caption p {
        font-size: 18px;
        margin-bottom: 25px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }
</style>