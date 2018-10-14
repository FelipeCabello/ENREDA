<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->sesion)
			header('Location: '.base_url().'login/');

		$this->load->model("InicioModel");
		
	}

	public function index()	{

		$this->load->view('inicio/index');

	}

	public function registro()	{
		if($this->input->post()){

			if (!isset($_POST["checkbox"])) {
				$checkbox = 0;
			} else {
				$checkbox = 1;
			}

			$nombreFac = $_POST["nombreFac"];
			$fechaFac = $_POST["fechaFac"];
			$contrato = $_POST["contrato"];
			$precioFac = $_POST["precioFac"];
			$ivaFac = $_POST["ivaFac"];
			$totalFac = $_POST["totalFac"];
			$nombreCont = $_POST["nombreCont"];
			$fechaCont = $_POST["fechaCont"];
			$id = $_POST["contrato"];

			$fileFac = array();
			$fileFac = $_FILES['archivoFac'];

			if ($this->InicioModel->registro($nombreFac, $fechaFac, $fileFac, $checkbox, $contrato, $precioFac, $ivaFac, $totalFac, $nombreCont, $fechaCont, $id)) {
			}

			header('Location: '.base_url().'inicio/');
		}

	}

	public function obtener_tabla() {

		$this->InicioModel->obtener_tabla();
	}

	public function obtener_datos()	{
		$id = $this->input->post('id');

		$this->InicioModel->obtener_datos($id);

	}

	public function borrar_datos()	{
		$id = $this->input->post('id');

		$this->InicioModel->borrar_datos($id);

		header('Location:'.base_url().'inicio/');

	}

}
