<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Principal', 'mP');
		$this->load->library('session');
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
		$this->load->view('genericos/header');
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
		$datos["direcciones"] = $this->mP->obtener_direcciones($id); // Agregar esta línea
	
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
}
