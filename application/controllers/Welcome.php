<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Principal', 'mP');
		$this->load->library('session');
		$this->load->library('email');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$datos["carruseles"]=$this->mP->consultar_carrusel();
		$datos["secciones"]=$this->mP->consultar_secciones();
		$datos["categorias"]=$this->mP->consultar_categorias();
		$datos["servicios"]=$this->mP->consultar_servicios();
		// $datos["carrera"]="LATI";
		// $datos["Mensaje"]="Esto es un mensaje de prueba";
		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('carrusel', $datos);
		$this->load->view('listado_servicios', $datos);
		$this->load->view('genericos/footer');
	}

	public function registrate()
	{
		$datos["secciones"]=$this->mP->consultar_secciones();
		$datos["categorias"]=$this->mP->consultar_categorias();
		$datos["servicios"]=$this->mP->consultar_servicios();
	
		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('registro');
		$this->load->view('genericos/footer');
	}

	public function detalle_servicio($id)
	{
		$datos["categorias"] = $this->mP->consultar_categorias();
		$datos["secciones"]=$this->mP->consultar_secciones();
		$resultado = $this->mP->detalle_servicio($id);
	
		if (!$resultado) {
			show_404();
			return;
		}
	
		$datos["servicio"] = $resultado["servicio"];
		$datos["comentarios"] = $resultado["comentarios"];
		$datos["carrusel"] = $resultado["carrusel"];
	
		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('servicios', $datos);
		$this->load->view('genericos/footer');
	}

	public function servicio_categoria($id)
	{
		$resultado = $this->mP->servicio_categoria($id);
		$datos["secciones"] = $this->mP->consultar_secciones();
		$datos["categorias"] = $this->mP->consultar_categorias();

		if(!$resultado){
			show_404();
			return;
		}

		$datos["nombre_servicio"] = $resultado["nombre_servicio"];
		$datos["lista_servicios"] = $resultado["lista_servicios"];

		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('categorias', $datos);
		$this->load->view('genericos/footer');
	}

	public function catalogos_productos()
	{
		$this->load->view('genericos/header');
		$this->load->view('menu');
		$this->load->view('listado_productos');
		$this->load->view('genericos/footer');
	}

	public function contrataciones($id){
		$datos["secciones"] = $this->mP->consultar_secciones();
		$datos["categorias"] = $this->mP->consultar_categorias();
		$datos["contrataciones_pagadas"] = $this->mP->obtener_contrataciones_pagadas($id);
		$datos["contrataciones_por_pagar"] = $this->mP->obtener_contrataciones_por_pagar($id);
		$datos["contrataciones_finalizadas"] = $this->mP->obtener_contrataciones_finalizadas($id);
	
		if (!$datos) {
			show_404();
			return;
		}
	
		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('contrataciones', $datos);
		$this->load->view('genericos/footer');
	}

	public function login() 
	{
		try {
			$correo = $this->input->post('email');
			$password = $this->input->post('password');
			
			if (empty($correo) || empty($password)) {
				echo json_encode(['status' => 'error', 'message' => 'Correo y contraseña son requeridos']);
				return;
			}
			
			$usuario = $this->mP->validar_usuario($correo, $password);
			
			if($usuario === FALSE) {
				echo json_encode(['status' => 'error', 'message' => 'Error de conexión con la base de datos']);
				return;
			}
			
			if(is_array($usuario) && count($usuario) > 0) {
				$session_data = array(
					'id' => $usuario[0]->id,
					'nombre' => $usuario[0]->nombre,
					'correo' => $usuario[0]->correo,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($session_data);
				
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Credenciales inválidas']);
			}
		} catch (Exception $e) {
			log_message('error', 'Error en login: ' . $e->getMessage());
			echo json_encode(['status' => 'error', 'message' => 'Error al iniciar sesión']);
		}
	}

	public function logout() 
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

    public function guardar_usuario() 
	{
        $usuario = $this->input->post('usuario');

        if (!$usuario || empty($usuario['nombres']) || empty($usuario['apellidoP']) || empty($usuario['apellidoM']) || empty($usuario['rfc']) || empty($usuario['correo']) || empty($usuario['contra']) || empty($usuario['telefono'])) {
            echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
            return;
        }

        $this->load->model('Principal');
        $resultado = $this->Principal->guardar_usuario($usuario);

        if ($resultado) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar el usuario.']);
        }
    }

	public function guardar_direccion(){
		$direccion = $this->input->post('direccion');
		$id_usuario = $this->session->userdata('id');

		if (!$direccion || empty($direccion['calle']) || empty($direccion['numeroExt']) || empty($direccion['colonia']) || empty($direccion['codigoPostal'])) {
			echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
			return;
		}

		$this->load->model('Principal');
		$resultado = $this->mP->guardar_direccion($id_usuario, $direccion);

		if ($resultado) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar la dirección.']);
		}
	}

	public function actualizar_direccion(){
		$direccion = $this->input->post('direccion');
		$id_usuario = $this->session->userdata('id');

		if (!$direccion || empty($direccion['calle']) || empty($direccion['numeroExt']) || empty($direccion['colonia']) || empty($direccion['codigoPostal'])) {
			echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
			return;
		}

		$this->load->model('Principal');
		$resultado = $this->mP->actualizar_direccion($id_usuario, $direccion);

		if ($resultado) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar la dirección.']);
		}
	}

	public function obtener_datos_direccion($id_direccion)
	{
		$this->load->model('Principal');
		$resultado = $this->mP->obtener_datos_direccion($id_direccion);

		if ($resultado) {
			echo json_encode(['status' => 'success', 'data' => $resultado]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo obtener la dirección.']);
		}
	}

	public function eliminar_direccion($id_direccion)
	{
		$this->load->model('Principal');
		$resultado = $this->mP->eliminar_direccion($id_direccion);
	
		if ($resultado) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la dirección.']);
		}
	}

	public function mi_perfil($id){
		$datos["secciones"] = $this->mP->consultar_secciones();
		$datos["categorias"] = $this->mP->consultar_categorias();
		$resultado = $this->mP->mi_perfil($id);
		$datos["direcciones"] = $this->mP->obtener_direcciones($id);
	
		if (!$resultado) {
			show_404();
			return;
		}
	
		$datos["usuario"] = $resultado;
	
		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('mi_perfil', $datos);
		$this->load->view('genericos/footer');
	}

	public function mis_servicios($id){
		$datos["secciones"] = $this->mP->consultar_secciones();
		$datos["categorias"] = $this->mP->consultar_categorias();
		$datos["mis_servicios"] = $this->mP->obtener_mis_servicios($id); // Agregar esta línea
	
		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('mis_servicios', $datos);
		$this->load->view('genericos/footer');
	}

	public function buscar_servicios() {
		$term = $this->input->get('term');
		$this->load->model('Principal');
		$resultados = $this->mP->buscar_servicios($term);
		echo json_encode($resultados);
	}

	public function buscar($term = '') {
		$datos["secciones"] = $this->mP->consultar_secciones();
		$datos["categorias"] = $this->mP->consultar_categorias();
		$datos["servicios"] = $this->mP->buscar_servicios(urldecode($term));

		$this->load->view('genericos/header');
		$this->load->view('menu', $datos);
		$this->load->view('listado_servicios', $datos);
		$this->load->view('genericos/footer');
	}

	public function obtener_horario() {
		$id_servicio = $this->input->get('id_servicio');
		$id_usuario = $this->input->get('id_usuario');

		$this->load->model('Principal');

		$horarios = $this->mP->obtener_horario($id_servicio);
		$direcciones = $this->mP->obtener_direcciones($id_usuario);

		if ($horarios || $direcciones) {
			echo json_encode([
				'status' => 'success',
				'data' => [
					'horarios' => $horarios,
					'direcciones' => $direcciones
				]
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'No se pudieron obtener los datos.'
			]);
		}
	}

	public function contratar_servicio(){
		$id_usuario = $this->input->post('id_usuario');
		$id_servicio = $this->input->post('id_servicio');
		$id_direccion = $this->input->post('id_direccion');
		$precio_hora = $this->input->post('precio_hora');
		$fechas = $this->input->post('fechas');
		$correo = $this->input->post('correo_usuario');

		if (!$id_usuario || !$id_servicio || !$fechas || !$id_direccion || !$precio_hora) {
			echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
			return;
		}

		$bloques_por_fecha = [];

		foreach ($fechas as $item) {
			$fecha = $item['fecha'];
			$hora = (int)$item['hora'];

			$bloques_por_fecha[$fecha][] = $hora;
		}

		foreach ($bloques_por_fecha as $fecha => $horas) {
			sort($horas);
			$inicio = $horas[0];
			$anterior = $inicio;

			for ($i = 1; $i <= count($horas); $i++) {
				$hora_actual = $horas[$i] ?? null;

				if ($hora_actual !== $anterior + 1) {
					$data = [
						'id_servicio'   => $id_servicio,
						'id_usuario'    => $id_usuario,
						'id_direccion'    => $id_direccion,
						'monto'         => (($anterior - $inicio) + 1) * $precio_hora,
						'pagado'         => 'S',
						'fecha_hora'    => "$fecha " . str_pad($inicio, 2, '0', STR_PAD_LEFT) . ":00:00",
						'fecha_creacion'=> date('Y-m-d H:i:s'),
						'hora_inicio'   => $inicio,
						'hora_fin'      => $anterior,
					];

					$this->mP->contratar_servicio($data);

					$inicio = $hora_actual;
				}

				$anterior = $hora_actual;
			}
		}

		$datos_correo["usuario"] = $this->mP->mi_perfil($id_usuario);
		$datos_correo["servicio"] = $data;

		$mensaje = $this->load->view('correo/servicio_contratado', $datos_correo, TRUE);

		$config = array(
			'protocol'    => 'smtp',
			'smtp_host'   => 'smtp.gmail.com',
			'smtp_port'   => 587,
			'smtp_user'   => 'mttoservicexpress@gmail.com',
			'smtp_pass'   => 'umag oqor evvz zkcx',
			'smtp_crypto' => 'tls',
			'mailtype'    => 'html',
			'charset'     => 'utf-8',
			'newline'     => "\r\n"
		);
	
		$this->email->initialize($config);

		$from_email = 'sistemas.icesureste@gmail.com';
		if (empty($from_email)) {
			log_message('error', 'La dirección "from" está vacía.');
			return;
		}

		$this->email->from($from_email, 'ExpressService');
		$this->email->to($correo);
		$this->email->subject('Confirmación de contratación de servicio');
		$this->email->message($mensaje);

		if (!$this->email->send()) {
			log_message('error', 'No se pudo enviar el correo: ' . $this->email->print_debugger());
			echo json_encode([
				'status'  => 'success',
				'email'   => 'failed',
				'message' => 'Servicio contratado, pero no se pudo enviar el correo de confirmación.'
			]);
			return;
		}

		echo json_encode(['status' => 'success', 'message' => 'Servicio contratado y correo enviado.']);

	}

	public function actualizar_contrato(){
		$id_usuario = $this->input->post('idUsuario');
		$id_contratacion = $this->input->post('id_contratacion');
		$correo = $this->input->post('correo_usuario');

		$this->mP->pagar_servicios($id_contratacion);
		
		$datos_correo["usuario"] = $this->mP->mi_perfil($id_usuario);
		$datos = $this->mP->obtener_contrataciones($id_contratacion);
		$datos_correo["servicio"] = isset($datos[0]) ? $datos[0] : [];


		$mensaje = $this->load->view('correo/servicio_contratado', $datos_correo, TRUE);

		$config = array(
			'protocol'    => 'smtp',
			'smtp_host'   => 'smtp.gmail.com',
			'smtp_port'   => 587,
			'smtp_user'   => 'mttoservicexpress@gmail.com',
			'smtp_pass'   => 'umag oqor evvz zkcx',
			'smtp_crypto' => 'tls',
			'mailtype'    => 'html',
			'charset'     => 'utf-8',
			'newline'     => "\r\n"
		);
	
		$this->email->initialize($config);

		$from_email = 'sistemas.icesureste@gmail.com';
		if (empty($from_email)) {
			log_message('error', 'La dirección "from" está vacía.');
			return;
		}

		$this->email->from($from_email, 'ExpressService');
		$this->email->to($correo);
		$this->email->subject('Confirmación de contratación de servicio');
		$this->email->message($mensaje);

		if (!$this->email->send()) {
			log_message('error', 'No se pudo enviar el correo: ' . $this->email->print_debugger());
			echo json_encode([
				'status'  => 'success',
				'email'   => 'failed',
				'message' => 'Servicio contratado, pero no se pudo enviar el correo de confirmación.'
			]);
			return;
		}

		echo json_encode(['status' => 'success', 'message' => 'Servicio contratado y correo enviado.']);
	}

	public function contratar_servicio_despues(){
		$id_usuario = $this->input->post('id_usuario');
		$id_servicio = $this->input->post('id_servicio');
		$id_direccion = $this->input->post('id_direccion');
		$precio_hora = $this->input->post('precio_hora');
		$fechas = $this->input->post('fechas');

		if (!$id_usuario || !$id_servicio || !$fechas || !$id_direccion || !$precio_hora) {
			echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
			return;
		}

		$bloques_por_fecha = [];

		foreach ($fechas as $item) {
			$fecha = $item['fecha'];
			$hora = (int)$item['hora'];

			$bloques_por_fecha[$fecha][] = $hora;
		}

		foreach ($bloques_por_fecha as $fecha => $horas) {
			sort($horas);
			$inicio = $horas[0];
			$anterior = $inicio;

			for ($i = 1; $i <= count($horas); $i++) {
				$hora_actual = $horas[$i] ?? null;

				if ($hora_actual !== $anterior + 1) {
					$data = [
						'id_servicio'   => $id_servicio,
						'id_usuario'    => $id_usuario,
						'id_direccion'    => $id_direccion,
						'monto'         => (($anterior - $inicio) + 1) * $precio_hora,
						'pagado'         => 'N',
						'fecha_hora'    => "$fecha " . str_pad($inicio, 2, '0', STR_PAD_LEFT) . ":00:00",
						'fecha_creacion'=> date('Y-m-d H:i:s'),
						'hora_inicio'   => $inicio,
						'hora_fin'      => $anterior,
					];

					$this->mP->contratar_servicio($data);

					$inicio = $hora_actual;
				}

				$anterior = $hora_actual;
			}
		}

		echo json_encode(['status' => 'success', 'message' => 'Servicio guardado para pagar más tarde.']);

	}

	public function pagarTodo(){
		$json = file_get_contents('php://input');
		$datos = json_decode($json, true);

		if (!isset($datos['ids']) || !is_array($datos['ids']) || empty($datos['ids'])) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(['error' => 'No se recibieron IDs válidos.']));
		}

		$ids = $datos['ids'];
		$correo_usuario = $datos['correo_usuario'] ?? '';
		$idUsuario = $datos['idUsuario'] ?? null;

		$lista_contrataciones = [];

		foreach ($ids as $id) {
			$this->mP->pagar_servicios($id);

			$contratacion = $this->mP->obtener_contrataciones($id);
			if (!empty($contratacion)) {
				$lista_contrataciones[] = $contratacion[0];
			}
		}

		$datos_correo["usuario"] = $this->mP->mi_perfil($idUsuario);

		$datos_correo["contrataciones"] = $lista_contrataciones;

		$mensaje = $this->load->view('correo/servicios_contratados', $datos_correo, TRUE);

		$config = array(
			'protocol'    => 'smtp',
			'smtp_host'   => 'smtp.gmail.com',
			'smtp_port'   => 587,
			'smtp_user'   => 'mttoservicexpress@gmail.com',
			'smtp_pass'   => 'umag oqor evvz zkcx',
			'smtp_crypto' => 'tls',
			'mailtype'    => 'html',
			'charset'     => 'utf-8',
			'newline'     => "\r\n"
		);

		$this->email->initialize($config);

		$from_email = 'sistemas.icesureste@gmail.com';
		if (empty($from_email)) {
			log_message('error', 'La dirección "from" está vacía.');
			return;
		}

		$this->email->from($from_email, 'ExpressService');
		$this->email->to($correo_usuario);
		$this->email->subject('Confirmación de contratación de servicio');
		$this->email->message($mensaje);

		if (!$this->email->send()) {
			log_message('error', 'Error al enviar el correo: ' . $this->email->print_debugger());
		}

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode(['mensaje' => 'Contrataciones marcadas como pagadas y correo enviado.']));
	}

	public function cancelar_contratacion(){
		$id_contratacion = $this->input->post('id_contratacion');

		$this->load->model('Principal');
		$resultado = $this->mP->cancelar_contratacion($id_contratacion);
	
		if ($resultado) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo cancelar el servicio.']);
		}
	}

	public function obtenerContratacionDirecciones(){
		$id_contratacion = $this->input->get('id_contratacion');
		$id_usuario = $this->input->get('id_usuario');

		$datos["contratacion"] = $this->mP->obtener_contrataciones($id_contratacion);
		$datos["direcciones"] = $this->mP->obtener_direcciones($id_usuario);

		echo json_encode($datos);
	}

	public function actualizarDireccionContrato(){
		$id_contratacion = $this->input->post('id_contratacion');
		$id_direccion = $this->input->post('id_direccion');


		$this->load->model('Principal');
		$resultado = $this->mP->actualizarDireccionContrato($id_contratacion, $id_direccion);
	
		if ($resultado) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el contrato.']);
		}
	}

	public function agregar_comentario(){
		$id_usuario = $this->input->post('id_usuario');
		$comentario = $this->input->post('comentario');
		$id_servicio = $this->input->post('id_servicio');


		$this->load->model('Principal');
		$resultado = $this->mP->agregar_comentario($id_usuario, $comentario, $id_servicio);
	
		if ($resultado) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el contrato.']);
		}
	}

}
