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
		// $datos["carrera"]="LATI";
		// $datos["Mensaje"]="Esto es un mensaje de prueba";
		$this->load->view('genericos/header');
		$this->load->view('menu');
		$this->load->view('carrusel', $datos);
		$this->load->view('listado_servicios');
		$this->load->view('genericos/footer');
	}

	public function catalogos_productos()
	{
		$this->load->view('genericos/header');
		$this->load->view('menu');
		$this->load->view('listado_productos');
		$this->load->view('genericos/footer');
	}

	//public function mostrar(){
		//$datos["name"]="Alejandro";
		//this->load->view('prueba',$datos);
	//}
}
