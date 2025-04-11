<div class="container d-flex justify-content-center align-items-center">
    <div class="row w-100 justify-content-center" style="margin-top: 80px;">
        <div class="col-md-3 col-lg-3"></div>
        <div class="col-md-6 col-lg-6">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Bienvenido, regístrate</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" placeholder="Ingresa tus nombres">
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="apellidoP" class="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" id="apellidoP" placeholder="Ingresa tu apellido paterno">
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="apellidoM" class="form-label">Apellido materno</label>
                            <input type="text" class="form-control" id="apellidoM" placeholder="Ingresa tu apellido materno">
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="rfc" placeholder="Ingresa tu RFC">
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo">
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="contra" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contra" placeholder="Ingresa tu contraseña">
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="rep_contra" class="form-label">Repite tu contraseña</label>
                            <input type="password" class="form-control" id="rep_contra" placeholder="Repite tu contraseña">
                            <div id="mensaje-contra" style="margin-top: 5px; font-size: 0.9em;"></div>
                        </div>
                        <div class="mb-3" style="margin-top: 15px;">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" placeholder="Ingresa tu número de teléfono">
                        </div>
                        <center>
                            <div class="d-grid" style="margin-top: 20px;">
                                <button type="button" class="btn btn-primary" id="id-btn-guardar" onclick="guardarUsuario()">Registrarse</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3"></div>
    </div>
</div>

<script>
    document.getElementById('contra').addEventListener('input', validarCoincidencia);
    document.getElementById('rep_contra').addEventListener('input', validarCoincidencia);

    function validarCoincidencia() {
        const contra = document.getElementById('contra').value;
        const repContra = document.getElementById('rep_contra').value;
        const mensaje = document.getElementById('mensaje-contra');
        const btnGuardar = document.getElementById('id-btn-guardar');

        if (repContra === '') {
            mensaje.textContent = '';
            mensaje.style.color = '';  
            btnGuardar.disabled = true;
        } else if (contra === repContra) {
            mensaje.textContent = '✔ Las contraseñas coinciden';
            mensaje.style.color = 'green';
            btnGuardar.disabled = false;
        } else {
            mensaje.textContent = '✖ Las contraseñas no coinciden';
            mensaje.style.color = 'red';
            btnGuardar.disabled = true;
        }
    }


    function guardarUsuario() {
        const usuario = {
            nombres: document.getElementById('nombres').value.trim(),
            apellidoP: document.getElementById('apellidoP').value.trim(),
            apellidoM: document.getElementById('apellidoM').value.trim(),
            rfc: document.getElementById('rfc').value.trim(),
            correo: document.getElementById('correo').value.trim(),
            contra: document.getElementById('contra').value.trim(),
            telefono: document.getElementById('telefono').value.trim(),
        };

        if (!validarCampos(usuario)) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        if (!validarContrasena(usuario.contra)) {
            alert("La contraseña debe contener exactamente 12 caracteres alfanuméricos, incluyendo al menos una letra y un número.");
            return;
        }

        const urlGuardar = "<?php echo base_url('Welcome/guardar_usuario'); ?>";

        $.ajax({
            type: "POST",
            url: urlGuardar,
            data: { usuario: usuario },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Usuario registrado exitosamente.');
                    iniciarSesion(usuario.correo, usuario.contra);
                } else {
                    alert(result.message || 'Error al registrar el usuario.');
                }
            },
            error: function() {
                alert('Error de conexión. Intenta nuevamente.');
            }
        });
    }

    function validarCampos(usuario) {
        return Object.values(usuario).every(valor => valor !== '');
    }

    function validarContrasena(contra) {
        const alfanumericoRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{12,}$/;
        return alfanumericoRegex.test(contra);
    }

    function iniciarSesion(email, password) {
        const urlLogin = '<?php echo base_url('welcome/login'); ?>';

        $.ajax({
            url: urlLogin,
            type: 'POST',
            data: { email, password },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    window.location.href = '<?php echo base_url(); ?>';
                } else {
                    alert(response.message || 'Error al iniciar sesión.');
                }
            },
            error: function() {
                alert('Error al iniciar sesión. Por favor, inténtalo de nuevo.');
            }
        });
    }

</script>