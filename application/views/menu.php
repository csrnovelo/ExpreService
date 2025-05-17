<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="padding-top: 60px;">


<nav class="navbar navbar-default" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;">
    <div class="container-fluid">
        <div class="row" style="margin: 0 15px; display: flex; align-items: center; justify-content: space-between;">
            <div class="col-xs-3">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" class="img-responsive" style="height: 60px;">
            </a>
            </div>
            <div class="col-xs-9">
                <div class="navbar-form navbar-right" style="width: 100%;">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Busca un servicio..." autocomplete="off">
                        <span class="input-group-btn">
                        <button class="btn" type="button" style="background-color: #5271ff; color: white;" onclick="buscarServicio()">
                            <i class="glyphicon glyphicon-search"></i> Buscar
                        </button>
                        </span>
                        <div id="searchResults" class="search-results"></div>
                    </div>
                </div>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar" style="padding-top: 3px; padding-bottom: 3px;">
            <ul class="nav navbar-nav navbar-right">
                <?php foreach($secciones as $seccion): ?>
                    <?php if(trim($seccion->clave) === 'NTS'): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle nav-contenido" data-toggle="dropdown" style="font-size: 17px;">
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
                            <?php if($this->session->userdata('logged_in')): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-contenido" data-toggle="dropdown" style="font-size: 17px;">
                                        Bienvenido, <?php echo $this->session->userdata('nombre'); ?> <span class="caret"></span>
                                        <input type="text" value="<?php echo $this->session->userdata('id'); ?>" id="userId" hidden>
                                        <input type="text" id="correo_usuario" value="<?php  echo $this->session->userdata('correo'); ?>" hidden>
                                    </a>
                                    <ul class="dropdown-menu user-menu" style="background-color: #fff; padding: 10px; width: 200px;">
                                        <li>
                                            <a href="<?php echo base_url('welcome/mi_perfil/' . $this->session->userdata('id')); ?>" class="nav-contenido">
                                                <i class="glyphicon glyphicon-briefcase"></i> Mi perfil
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('welcome/mis_servicios/' . $this->session->userdata('id')); ?>" class="nav-contenido">
                                                <i class="glyphicon glyphicon-briefcase"></i> Mis Servicios
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('welcome/contrataciones/' . $this->session->userdata('id')); ?>" class="nav-contenido">
                                                <i class="glyphicon glyphicon-list-alt"></i> Mis Contrataciones
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="<?php echo base_url('welcome/logout'); ?>" class="nav-contenido">
                                                <i class="glyphicon glyphicon-log-out"></i> Cerrar Sesión
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#loginModal" class='nav-contenido' style="font-size: 17px;">
                                        <?php echo LimpiaCadena($seccion->nombre); ?>
                                    </a>
                                </li>
                            <?php endif; ?>          
                        <?php elseif(trim($seccion->clave) === 'CAT'): ?>
                        <li>
                            <a href="#"href="javascript:void(0)" class="dropdown-toggle nav-contenido" data-toggle="dropdown" style="font-size: 17px;">
                                <?php echo LimpiaCadena($seccion->nombre); ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu user-menu" style="background-color: #fff; padding: 10px; width: 200px;">
                                <?php foreach($categorias as $categoria): ?>
                                    <li>
                                        <a href="<?php echo base_url('welcome/servicio_categoria/' . $categoria->Id); ?>" class="nav-contenido">
                                            <?php echo LimpiaCadena($categoria->descripcion); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="#<?php echo $seccion->clave; ?>" class='nav-contenido' style="font-size: 17px;">
                            <?php echo LimpiaCadena($seccion->nombre); ?>
                        </a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
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
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background-color: #5271ff; border: none;">
                            Iniciar Sesión
                        </button>
                        <button class="btn btn-secondary" onclick="window.location.href='<?php echo base_url('welcome/registrate'); ?>'">
                            Registrarse
                        </button>
                    </div>
                    <div id="loginMessage"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= base_url(); ?>";
    
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?php echo base_url('welcome/login'); ?>',
            type: 'POST',
            data: {
                email: $('#email').val(),
                password: $('#password').val()
            },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    window.location.href = '<?php echo base_url(); ?>';
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Error al iniciar sesión. Por favor, inténtalo de nuevo.');
            }
        });
    });

    console.log('User ID:', document.getElementById('userId')).value;

    function buscarServicio() {
        const term = document.getElementById('searchInput').value;
        console.log("Buscando con término:", term); // Para depuración

        if (term.length > 0) {
            window.location.href = BASE_URL + "welcome/buscar/" + encodeURIComponent(term);
        }
    }

    function verDetalleServicio(id) {
        window.location.href = '<?php echo base_url('welcome/detalle_servicio/'); ?>' + id;
    }

</script>

<style>
    .search-results {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
        background: white;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-height: 300px;
        overflow-y: auto;
    }
    
    .search-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }
    
    .search-item:hover {
        background-color: #f5f5f5;
    }

    .dropdown-menu li a:hover {
        background-color: #f8f9fa;
        color: #5271ff !important;
    }

    .dropdown-menu .divider {
        margin: 8px 0;
        background-color: #eee;
    }

    .dropdown-menu li a i {
        margin-right: 10px;
        color: #5271ff;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
    .user-menu li a {
        font-size: 13px;
        padding: 6px 12px !important;
    }

    .user-menu li a i {
        font-size: 12px;
        margin-right: 8px;
        color: #5271ff;
    }

    .user-menu .divider {
        margin: 5px 0;
    }

    .dropdown-menu.user-menu {
        margin-top: 0;
    }

    .nav-contenido
      {
        font-size: 18px; 
      }
      
    @media (max-width: 768px) {
        .navbar-header {
            float: none;
        }
        .navbar-left, .navbar-right {
            float: none !important;
        }
        .navbar-toggle {
            display: block;
        }
        .navbar-collapse {
            border-top: 1px solid transparent;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
        }
        .navbar-fixed-top {
            top: 0;
            border-width: 0 0 1px;
        }
        .navbar-collapse.collapse {
            display: none!important;
        }
        .navbar-nav {
            float: none!important;
            margin-top: 7.5px;
        }
        .navbar-nav>li {
            float: none;
        }
        .navbar-nav>li>a {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .navbar-form {
            margin-top: 10px;
        }
        .navbar-form .input-group {
            width: 100%;
        }
    }
</style>

