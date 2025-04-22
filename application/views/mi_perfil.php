<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 mx-auto">
            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h2 class="card-title mb-4">Perfil del Usuario</h2>
                    <p><strong>Nombre:</strong> <?= $usuario['nombre'] ?></p>
                    <p><strong>Apellido paterno:</strong> <?= $usuario['apellido_paterno'] ?></p>
                    <p><strong>Apellido materno:</strong> <?= $usuario['apellido_materno'] ?></p>
                    <p><strong>Correo:</strong> <?= $usuario['correo'] ?></p>
                    <p><strong>Teléfono:</strong> <?= $usuario['telefono'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>

    <button class="btn btn-primary mt-3" data-bs-toggle="modal" onclick="abrirModal()" data-bs-target="#modalDireccion">Agregar Dirección</button>

    <div class="row mt-4">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Mis Direcciones</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Título</th>
                                    <th>Dirección</th>
                                    <th>Colonia</th>
                                    <th>CP</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaDirecciones">
                                <?php if(isset($direcciones) && !empty($direcciones)): ?>
                                    <?php foreach($direcciones as $direccion): ?>
                                        <tr>
                                            <td><?= $direccion['titulo'] ?></td>
                                            <td><?= $direccion['calle'] . ' #' . $direccion['num_exterior'] ?></td>
                                            <td><?= $direccion['colonia'] ?></td>
                                            <td><?= $direccion['codigo_postal'] ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="editarDireccion(<?= $direccion['id'] ?>)">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminarDireccion(<?= $direccion['id'] ?>)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay direcciones registradas</td>
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

<!-- Modal -->
<div class="modal fade" id="modalDireccion" tabindex="-1" aria-labelledby="modalDireccionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalDireccionLabel">Agregar Nueva Dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formDireccion">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="calle" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="titulo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="calle" class="form-label">Descripcion (opcional)</label>
                            <input type="text" class="form-control" id="descripcion">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" id="calle" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numeroExt" class="form-label">Número Exterior</label>
                            <input type="text" class="form-control" id="numeroExt" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numeroInt" class="form-label">Número Interior (opcional)</label>
                            <input type="text" class="form-control" id="numeroInt">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="colonia" class="form-label">Colonia</label>
                            <input type="text" class="form-control" id="colonia" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="codigoPostal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codigoPostal" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cerrarModal()">Cancelar</button>
                <button type="button" class="btn btn-primary" id="id_btn_guardar" onclick="guardarDireccion()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let id_direccion = null;

    function abrirModal() {
        $('#modalDireccion').modal('show');
    }

    function cerrarModal() {
        $('#modalDireccion').modal('hide');
        document.getElementById('titulo').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('calle').value = '';
        document.getElementById('numeroExt').value = '';
        document.getElementById('numeroInt').value = '';
        document.getElementById('colonia').value = '';
        document.getElementById('codigoPostal').value = '';

        id_direccion = null;
    }

    function guardarDireccion() {
        if(id_direccion){
            actualizar_direccion(id_direccion);
        } else{
            const btn_guardar = document.getElementById('id_btn_guardar');
            btn_guardar.disabled = true;
            const direccion = {
               titulo: document.getElementById('titulo').value,
               descripcion: document.getElementById('descripcion').value,
               calle: document.getElementById('calle').value,
               numeroExt: document.getElementById('numeroExt').value,
               numeroInt: document.getElementById('numeroInt').value,
               colonia: document.getElementById('colonia').value,
               codigoPostal: document.getElementById('codigoPostal').value,
           };
           
           $.ajax({
               url: '<?= base_url("welcome/guardar_direccion") ?>',
               type: 'POST',
               data: { direccion: direccion, id_usuario: document.getElementById('userId').value },
               dataType: 'json',
               success: function(response) {
                   if (response.status === 'success') {
                       alert('Dirección guardada exitosamente');
                       location.reload();
                       cerrarModal();
                   } else {
                       alert('Error al guardar la dirección: ' + response.message);
                   }
               },
               error: function(xhr, status, error) {
                   alert('Error en la solicitud: ' + error);
               }
           });
           
           btn_guardar.disabled = false;
        }   
    }

    function actualizar_direccion(id_direccion){
        alert(id_direccion);
    }

    function editarDireccion(id) {
        $.ajax({
            url: '<?= base_url("welcome/obtener_datos_direccion") ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const direccion = response.data;
                    id_direccion = direccion.id;
                    document.getElementById('titulo').value = direccion.titulo;
                    document.getElementById('descripcion').value = direccion.descripcion;
                    document.getElementById('calle').value = direccion.calle;
                    document.getElementById('numeroExt').value = direccion.num_exterior;
                    document.getElementById('numeroInt').value = direccion.num_interior;
                    document.getElementById('colonia').value = direccion.colonia;
                    document.getElementById('codigoPostal').value = direccion.codigo_postal;
                    $('#modalDireccion').modal('show');
                } else {
                    alert('Error al obtener la dirección: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error en la solicitud: ' + error);
            }
        });
    }

    function eliminarDireccion(id) {
        $.ajax({
            url: '<?= base_url("welcome/eliminar_direccion") ?>/' + id,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Dirección eliminada exitosamente');
                    location.reload();
                } else {
                    alert('Error al eliminar la dirección: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error en la solicitud: ' + error);
            }
        });
        console.log(id);
    }
</script>