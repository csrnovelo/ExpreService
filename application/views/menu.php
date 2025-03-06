<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" style="height: 100px; margin-top: -20px; margin-bottom: 30px;">
        </a>
    
        <div class="navbar-form navbar-left" style="margin-top: 35px;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Busca un servicio..." style="width: 300px;">
                <span class="input-group-btn">
                    <button class="btn" type="button" style="background-color: #5271ff; color: white;">
                        <i class="glyphicon glyphicon-search"></i> Buscar
                    </button>
                </span>
            </div>
        </div>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar" style="padding-top: 15px; padding-bottom: 15px;">
        <ul class="nav navbar-nav navbar-right">
            <?php foreach($secciones as $seccion): ?>
                <?php if(trim($seccion->clave) === 'NTS'): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle nav-contenido" data-toggle="dropdown">
                            <?php echo LimpiaCadena($seccion->nombre); ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="background-color: #fff; padding: 15px; width: 300px;">
                            <li>
                                <h4 style="color: #5271ff; margin-bottom: 10px;">ExpreService</h4>
                                <p style="color: #333; font-size: 14px; line-height: 1.5;">
                                    Somos una plataforma líder en la conexión de servicios profesionales 
                                    con clientes.
                                </p>
                                <hr>
                                <a href="#nosotros" class="btn btn-sm" style="background-color: #5271ff; color: white;">
                                    Conoce más
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php elseif(trim($seccion->clave) === 'INS'): ?>
                    <li><a href="#" data-toggle="modal" data-target="#loginModal" class='nav-contenido'>
                        <?php echo LimpiaCadena($seccion->nombre); ?>
                    </a></li>
                <?php else: ?>
                    <li><a href="#<?php echo $seccion->clave; ?>" class='nav-contenido'>
                        <?php echo LimpiaCadena($seccion->nombre); ?>
                    </a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>




<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="loginModalLabel" style="color: #5271ff;">Iniciar Sesión/Registrarse</h4>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background-color: #5271ff; border: none;">
                            Iniciar Sesión
                        </button>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p>¿No tienes una cuenta? <a href="#" style="color: #5271ff;">Regístrate aquí</a></p>
                        <a href="#" style="color: #5271ff;">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>