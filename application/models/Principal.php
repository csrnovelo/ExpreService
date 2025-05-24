<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Model
{
    public function validar_usuario($correo, $password)
    {
        $sql = "SELECT id, nombre, correo FROM usuarios 
                WHERE correo = '$correo' AND contra = '$password' AND estatus = 1";
    
        $query = $this->db->query($sql);
    
        if ($query) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    function consultar_carrusel()
    {
        $sql="exec pa_consultar_carrusel";
        $query=$this->db->query($sql);
        if($query!=false){
            if($query->num_rows()>0){
                return $query->result();
            }
        }else{
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('welcome');
    }

    public function guardar_usuario($usuario) {
        $sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, rfc, correo, contra, telefono, estatus, fecha_creacion)
        VALUES (
            '{$usuario['nombres']}',
            '{$usuario['apellidoP']}',
            '{$usuario['apellidoM']}',
            '{$usuario['rfc']}',
            '{$usuario['correo']}',
            '{$usuario['contra']}',
            '{$usuario['telefono']}',
            1,
            GETDATE()
        )";

        return $this->db->query($sql);

    }

    public function guardar_direccion($id_usuario, $direccion){
        $sql = "INSERT INTO usuarios_direcciones (id_usuario, titulo, descripcion, colonia, calle, codigo_postal, num_exterior, num_interior, estatus, fecha_creacion)
        VALUES (
            $id_usuario,
            '{$direccion['titulo']}',
            '{$direccion['descripcion']}',
            '{$direccion['colonia']}',
            '{$direccion['calle']}',
            '{$direccion['codigoPostal']}',
            '{$direccion['numeroExt']}',
            '{$direccion['numeroInt']}',
            1,
            GETDATE()
        )";
        return $this->db->query($sql);
    }

    public function actualizar_direccion($id_usuario, $direccion) {
        $id_usuario = (int) $id_usuario;
        $id_direccion = isset($direccion['id']) ? (int) $direccion['id'] : null;
    
        if ($id_direccion) {
            $sql = "UPDATE usuarios_direcciones SET
                        titulo = '{$direccion['titulo']}',
                        descripcion = '{$direccion['descripcion']}',
                        colonia = '{$direccion['colonia']}',
                        calle = '{$direccion['calle']}',
                        codigo_postal = '{$direccion['codigoPostal']}',
                        num_exterior = '{$direccion['numeroExt']}',
                        num_interior = '{$direccion['numeroInt']}'
                    WHERE id = $id_direccion AND id_usuario = $id_usuario";
        } else {
            $sql = "INSERT INTO usuarios_direcciones (
                        id_usuario, titulo, descripcion, colonia, calle,
                        codigo_postal, num_exterior, num_interior, estatus, fecha_creacion
                    ) VALUES (
                        $id_usuario,
                        '{$direccion['titulo']}',
                        '{$direccion['descripcion']}',
                        '{$direccion['colonia']}',
                        '{$direccion['calle']}',
                        '{$direccion['codigoPostal']}',
                        '{$direccion['numeroExt']}',
                        '{$direccion['numeroInt']}',
                        1,
                        GETDATE()
                    )";
        }
    
        return $this->db->query($sql);
    }
    
    public function obtener_direcciones($id_usuario) {
        $sql = "SELECT 
                    id,
                    titulo,
                    calle,
                    num_exterior,
                    num_interior,
                    colonia,
                    codigo_postal
                FROM usuarios_direcciones 
                WHERE id_usuario = ? 
                AND estatus = 1";
        
        $query = $this->db->query($sql, array($id_usuario));
        return $query->result_array();
    }

    public function obtener_datos_direccion($id_direccion) {
        $sql = "SELECT 
                    id,
                    titulo,
                    descripcion,
                    calle,
                    num_exterior,
                    num_interior,
                    colonia,
                    codigo_postal
                FROM usuarios_direcciones 
                WHERE id = ? 
                AND estatus = 1";
        
        $query = $this->db->query($sql, array($id_direccion));
        return $query->row_array();
    }

    public function eliminar_direccion($id_direccion) {
        $sql = "UPDATE usuarios_direcciones
                SET estatus = 0
                WHERE id = ?";
        
        $query = $this->db->query($sql, array($id_direccion));
        return $query;
    }

    function consultar_secciones()
    {
        $sql="exec pa_consultar_secciones";
        $query=$this->db->query($sql);
        if($query!=false){
            if($query->num_rows()>0){
                return $query->result();
            }
        }else{
            return false;
        }
    }

    function consultar_categorias()
    {
        $sql="exec pa_consultar_categorias";
        $query=$this->db->query($sql);
        if($query!=false){
            if($query->num_rows()>0){
                return $query->result();
            }
        }else{
            return false;
        }
    }

    function consultar_servicios()
    {
        $sql="exec pa_consultar_servicios";
        $query=$this->db->query($sql);
        if($query!=false){
            if($query->num_rows()>0){
                return $query->result();
            }
        }else{
            return false;
        }
    }
    
    public function detalle_servicio($id)
    {
        $sql = "SELECT 
                    s.Id AS servicio_id,
                    s.titulo,
                    s.descripcion AS servicio_descripcion,
                    s.precio_hora,
                    s.fecha_creacion AS servicio_fecha_creacion,
                    sc.descripcion AS categoria_descripcion,
                    u.nombre AS usuario_nombre,
                    u.apellido_paterno AS usuario_apellido
                FROM servicios s
                JOIN servicios_categorias sc ON s.Id_categoria = sc.Id
                INNER JOIN usuarios u ON s.id_usuario = u.Id
                WHERE s.id = ?"; 
        
        $comentarios = "SELECT
                    c.Id AS id_comentario,
                    c.comentario,
                    c.calificacion,
                    c.fecha_creacion AS comentario_fecha_creacion,
                    u.nombre AS usuario_nombre,
                    u.apellido_paterno AS usuario_apellido
                FROM criticas c
                INNER JOIN usuarios u ON c.id_cliente = u.Id
                WHERE c.id_servicio = ?";

        $carrusel_servicios = "SELECT img FROM servicios_carrusel WHERE id_servicio = ?";
    
        $query_servicio = $this->db->query($sql, array($id));
    
        if ($query_servicio->num_rows() == 0) {
            return false;
        }
    
        $query_comentarios = $this->db->query($comentarios, array($id));
        $query_carrusel = $this->db->query($carrusel_servicios, array($id));
    
        return [
            'servicio'   => $query_servicio->row_array(),
            'comentarios' => $query_comentarios->result_array(),
            'carrusel' => $query_carrusel->result_array(),
        ];
    }

    public function servicio_categoria($id){
        $nombre_servicio = "SELECT 
                                sc.Id, 
                                sc.descripcion, 
                                sc.estatus 
                            FROM servicios_categorias sc 
                            WHERE sc.estatus = 1 
                            AND sc.Id = ?";
    
        $lista_servicios = "SELECT
                                s.Id,
                                s.id_usuario,
                                s.id_categoria,
                                s.titulo,
                                s.descripcion,
                                s.precio_hora,
                                s.estatus,
                                s.img,
                                u.nombre AS nombre_usuario,
                                u.apellido_paterno AS usuario_apellido
                            FROM servicios s
                            JOIN usuarios u ON s.id_usuario = u.Id
                            WHERE s.id_categoria = ? 
                            AND s.estatus = 1";
    
        $query = $this->db->query($nombre_servicio, [$id]);
        $nombre_servicio = $query->row();
    
        $query = $this->db->query($lista_servicios, [$id]);
        $lista_servicios = $query->result();
    
        return [
            'nombre_servicio' => $nombre_servicio,
            'lista_servicios' => $lista_servicios
        ];
    }

    public function mi_perfil($id){
        $sql = "SELECT 
                    u.Id,
                    u.nombre,
                    u.apellido_paterno,
                    u.apellido_materno,
                    u.rfc,
                    u.correo,
                    u.telefono,
                    u.fecha_creacion
                FROM usuarios u
                WHERE u.Id = ?";
    
        $query = $this->db->query($sql, array($id));
    
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }    
    }

    public function buscar_servicios($term) {
        $this->db->query("SET ANSI_WARNINGS OFF");
        $sql = "SELECT 
                    s.Id, 
                    CAST(s.titulo AS NVARCHAR(4000)) AS titulo,
                    CAST(s.descripcion AS NVARCHAR(4000)) AS descripcion,
                    s.precio_hora,
                    s.img,
                    CAST(u.nombre AS NVARCHAR(4000)) AS nombre_usuario,
                    CAST(u.apellido_paterno AS NVARCHAR(4000)) AS apellido_paterno,
                    CAST(sc.descripcion AS NVARCHAR(4000)) AS categoria,
                    CAST(ISNULL(AVG(NULLIF(c.calificacion, 0)), 0) AS DECIMAL(4,2)) AS promedio_calificacion
                FROM servicios s
                INNER JOIN usuarios u ON s.id_usuario = u.Id
                INNER JOIN servicios_categorias sc ON s.id_categoria = sc.Id
                LEFT JOIN criticas c ON s.Id = c.id_servicio
                WHERE s.estatus = 1 
                AND (
                    s.titulo LIKE ? OR 
                    s.descripcion LIKE ? OR 
                    sc.descripcion LIKE ? OR
                    u.nombre LIKE ? OR
                    u.apellido_paterno LIKE ?
                )
                GROUP BY 
                    s.Id, 
                    CAST(s.titulo AS NVARCHAR(4000)),
                    CAST(s.descripcion AS NVARCHAR(4000)),
                    s.precio_hora,
                    s.img,
                    CAST(u.nombre AS NVARCHAR(4000)),
                    CAST(u.apellido_paterno AS NVARCHAR(4000)),
                    CAST(sc.descripcion AS NVARCHAR(4000))
                ORDER BY s.Id
                OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY";
    
        $param = array(
            '%' . $term . '%',
            '%' . $term . '%',
            '%' . $term . '%',
            '%' . $term . '%',
            '%' . $term . '%'
        );
    
        $query = $this->db->query($sql, $param);
        return ($query->num_rows() > 0) ? $query->result() : array();
        $this->db->query("SET ANSI_NULLS ON");

    }

    public function obtener_mis_servicios($id_usuario) {
        $sql = "SELECT 
                    s.Id,
                    s.id_usuario,
                    s.id_categoria,
                    sc.descripcion AS categoria,
                    s.titulo,
                    s.descripcion,
                    s.precio_hora,
                    s.img
                FROM servicios s 
                INNER JOIN servicios_categorias sc ON s.id_categoria = sc.Id
                WHERE s.id_usuario = ? 
                AND s.estatus = 1";
        
        $query = $this->db->query($sql, array($id_usuario));
        return $query->result_array();
    }

    public function obtener_horario($id_servicio) {
        $sql = "SELECT 
                    h.Id,
                    h.id_servicio,
                    h.dia,
                    h.hora_inicio,
                    h.hora_fin
                FROM servicios_horarios h
                WHERE h.id_servicio = ? 
                AND h.estatus = 1";
        
        $query = $this->db->query($sql, array($id_servicio));
        return $query->result_array();
    }

    public function contratar_servicio($data){
        $data['hora_inicio'] = str_pad($data['hora_inicio'], 2, '0', STR_PAD_LEFT) . ':00:00';
        $data['hora_fin']    = str_pad($data['hora_fin'], 2, '0', STR_PAD_LEFT) . ':00:00';

        $sql = "INSERT INTO contrataciones (
                    id_servicio, id_usuario, id_direccion, monto, estatus, pagado, fecha_hora, fecha_creacion, hora_inicio, hora_fin
                ) VALUES (
                    {$data['id_servicio']},
                    {$data['id_usuario']},
                    {$data['id_direccion']},
                    {$data['monto']},
                    1,
                    '{$data['pagado']}',
                    '{$data['fecha_hora']}',
                    '{$data['fecha_creacion']}',
                    '{$data['hora_inicio']}',
                    '{$data['hora_fin']}'
                )";

        return $this->db->query($sql);
    }

    public function obtener_contrataciones_pagadas($id) {
        $sql = "SELECT c.monto, c.Id, c.hora_fin, c.hora_inicio, c.fecha_hora, 
                    d.titulo as lugar, s.titulo as servicio 
                FROM contrataciones c
                INNER JOIN usuarios_direcciones d ON d.Id = c.id_direccion
                INNER JOIN servicios s ON s.Id = c.id_servicio
                WHERE c.pagado = 'S' 
                AND c.id_usuario = ? 
                AND CONVERT(date, c.fecha_hora) >= CONVERT(date, GETDATE())";
        
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function obtener_contrataciones_por_pagar($id){
        $sql = "SELECT c.monto, c.Id, c.hora_fin, c.hora_inicio, c.fecha_hora, d.titulo as lugar, s.titulo as servicio 
                FROM contrataciones c
                INNER JOIN usuarios_direcciones d ON d.Id = c.id_direccion
                INNER JOIN servicios s ON s.Id = c.id_servicio
                WHERE c.pagado = 'N' 
                AND c.id_usuario = ? 
                AND CAST(c.fecha_hora AS DATE) >= CAST(GETDATE() AS DATE)";

        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function obtener_contrataciones_finalizadas($id){
        $sql = "SELECT c.monto, c.Id, c.hora_fin, c.hora_inicio, c.fecha_hora, d.titulo as lugar, s.titulo as servicio FROM contrataciones c
                INNER JOIN usuarios_direcciones d ON d.Id = c.id_direccion
                INNER JOIN servicios s ON s.Id = c.id_servicio
                WHERE c.pagado = 'S' AND c.id_usuario = ?
                AND CONVERT(date, c.fecha_hora) <= CONVERT(date, GETDATE())";

        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function pagar_servicios($id){
        $sql = "UPDATE contrataciones SET pagado = 'S' WHERE Id = ?";
        return $this->db->query($sql, array($id));
    }

    public function obtener_contrataciones($id_contratacion){
        $sql = "SELECT c.Id, c.id_servicio, c.id_direccion, s.titulo, u.nombre, c.fecha_hora, c.monto, c.hora_inicio, c.hora_fin from contrataciones c
                inner join usuarios u on u.Id = c.id_usuario
                inner join servicios s on s.Id = c.id_servicio
                inner join usuarios_direcciones ud on ud.Id = c.id_direccion
                where c.Id = ?";

        $query = $this->db->query($sql, array($id_contratacion));
        return $query->result_array();
    }

    public function cancelar_contratacion($id_contratacion){
        $sql = "UPDATE contrataciones SET pagado = 'C' WHERE Id = ?";
        return $this->db->query($sql, array($id_contratacion));
    }

    public function actualizarDireccionContrato($id_contratacion, $id_direccion) {
        $sql = "UPDATE contrataciones 
                SET id_direccion = ? 
                WHERE Id = ?";
        
        return $this->db->query($sql, array($id_direccion, $id_contratacion));
    }

    public function agregar_comentario($id_usuario, $comentario, $id_servicio) {
        $fecha_creacion = date('Y-m-d'); // formato: 2025-03-23

        $sql = "INSERT INTO criticas (id_cliente, id_servicio, comentario, estatus, fecha_creacion) 
                VALUES (?, ?, ?, 1, ?)";

        return $this->db->query($sql, array($id_usuario, $id_servicio, $comentario, $fecha_creacion));
    }

}
