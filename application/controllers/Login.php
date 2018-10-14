<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("LoginModel");
	}

	public function index()	{
		$this->load->view('login/index');

	}

	public function registro()	{
		if($this->input->post()){
			$usuario = $_POST["usuario"];
			$password = $_POST["password"];
			if ($this->LoginModel->registro($usuario, $password)) {
				header('Location: '.base_url().'/inicio/');
			}
		}

	}
}
