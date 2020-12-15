<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->database();
	
	  }

	public function index()
	{
		$this->load->view("Registro");
	}
	
	/**
    * Registra un nuevo usuario en el sistema   
    */
	
	public function registrar(){

		$nombre = $this->input->post("nombre");

		$primerApellido = $this->input->post("primerApellido");
		
		$segundoApellido = $this->input->post("segundoApellido");
		
		$telefono = $this->input->post("telefono");
		
		$correo = $this->input->post("correo");
		
		$direccion = $this->input->post("direccion");
		
		$nombreUsuario = $this->input->post("nombreUsuario");
		
        $contrasenna = $this->input->post("contrasenna");
        
        $verificarNombreExiste = $this->RegistroModel->verificarExistenciaNombreUsuario($nombreUsuario);

		if($verificarNombreExiste == 0){
		$info = $this->RegistroModel->guardar($nombre,$primerApellido,$segundoApellido,$telefono,$correo,$direccion,$nombreUsuario,$contrasenna);

		if($info){
		echo '<script type="text/javascript">alert("Sus datos se han registrado exitosamente")</script>';

		// redirect(site_url("Login"));
		$this->load->view("Login");
		}
	}
	else{
		echo '<script type="text/javascript">alert("Registro fallido, este nombre de usuario ya se encuentra en uso")</script>';

		$this->load->view("Registro");
    }

	}
}