<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function registro($_usuario, $_pass)	{
		// COMPROBAR EL USUARIO
		$sql = "SELECT * from usuario where usuario='".$_usuario."' and password='".$_pass."'; ";

		$usuario_result = $this->db->query($sql)->result();

		if (count($usuario_result)=='1') {
			$this->session->sesion = TRUE;
			header('Location: '.base_url().'inicio/');
		} else {
			return "false";
		}
	}
}
