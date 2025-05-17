<div class="container py-5" style="margin-top: 50px;">
    <div class="row mb-4">
        <div class="col-lg-12 mx-auto text-center">
            <h1 class="display-4">Mis Servicios</h1>
            <p class="lead">Aquí puedes gestionar tus servicios de envío.</p>
        </div>
    </div>

    <button class="btn btn-primary mt-3" data-bs-toggle="modal" onclick="abrirModal()" data-bs-target="#modalDireccion">Agregar Servicio</button>

    <div class="row mt-4">
        <div class="col-lg-12 mx-auto">
            <div class="card shadow rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Mis Servicios</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Precio por hora</th>
                                    <th>Categoría</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaServicios">
                                <?php if (isset($mis_servicios) && !empty($mis_servicios)) : ?>
                                    <?php foreach ($mis_servicios as $servicio): ?>
                                        <tr>
                                            <td><?= $servicio['titulo'] ?></td>
                                            <td><?= $servicio['descripcion'] ?></td>
                                            <td>$<?= $servicio['precio_hora'] ?></td>
                                            <td><?= $servicio['categoria'] ?></td>
                                            <td>
                                                <?php if (!empty($servicio['img'])): ?>
                                                    <img src="<?= base_url('assets/images/' . $servicio['img']) ?>" alt="Imagen del servicio" width="100">
                                                <?php else: ?>
                                                    <span>Sin imagen</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="editarServicio(<?= $servicio['Id'] ?>)">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminarServicio(<?= $servicio['Id'] ?>)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No tienes servicios registrados</td>
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
        const direccion = {
               titulo: document.getElementById('titulo').value,
               descripcion: document.getElementById('descripcion').value,
               calle: document.getElementById('calle').value,
               numeroExt: document.getElementById('numeroExt').value,
               numeroInt: document.getElementById('numeroInt').value,
               colonia: document.getElementById('colonia').value,
               codigoPostal: document.getElementById('codigoPostal').value,
           };

        if(id_direccion){
            direccion.id = id_direccion;
            actualizar_direccion(direccion);
        } else{
            const btn_guardar = document.getElementById('id_btn_guardar');
            btn_guardar.disabled = true;
           
           $.ajax({
               url: '<?= base_url("welcome/guardar_direccion") ?>',
               type: 'POST',
               data: { direccion: direccion, id_usuario: document.getElementById('userId').value },
               dataType: 'json',
               success: function(response) {
                   if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: 'Dirección guardada exitosamente'
                        }).then(() => {
                            location.reload();
                            cerrarModal();
                        });
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

    function actualizar_direccion(direccion){
        $.ajax({
               url: '<?= base_url("welcome/actualizar_direccion") ?>',
               type: 'POST',
               data: { direccion: direccion, id_usuario: document.getElementById('userId').value },
               dataType: 'json',
               success: function(response) {
                   if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualizado',
                            text: 'Dirección actualizada exitosamente'
                        }).then(() => {
                            location.reload();
                            cerrarModal();
                        });
                   } else {
                       alert('Error al actualizar la dirección: ' + response.message);
                   }
               },
               error: function(xhr, status, error) {
                   alert('Error en la solicitud: ' + error);
               }
           });
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
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará la dirección seleccionada.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("welcome/eliminar_direccion") ?>/' + id,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'Dirección eliminada exitosamente'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo eliminar: ' + response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en la solicitud',
                            text: error
                        });
                    }
                });
            }
        });
    }
</script>