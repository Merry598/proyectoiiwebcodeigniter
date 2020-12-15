<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginCont extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$this->load->library('session');
		$this->load->view("Login");
	}
	/**
    *Validar si el usuario especificado se encuentra registrado en el sistema   
    */
	public function validar(){
	
		if($this->input->post())
    {
        $usuario = $this->input->post("nUsu");
		$contrasenna = $this->input->post("passUsu");
		
		$info =$this->LoginVerificator->validarDatos($usuario,$contrasenna);

		if($info){

			foreach($info as $row){
				if ($row->privilegio == 1){
				
				$this->session->set_userdata('id',$row->id);
				$this->session->set_userdata('usuario',$row->nombre_usuario);
				$this->session->set_userdata('privilegio',$row->privilegio);
				$this->session->set_userdata('logeado',TRUE);


				redirect(site_url(["Admin"]));
	
			}
			else if($row->privilegio == 0){
					
				$this->session->set_userdata('id',$row->id);
				$this->session->set_userdata('usuario',$row->nombre_usuario);
				$this->session->set_userdata('privilegio',$row->privilegio);
				$this->session->set_userdata('logeado',TRUE);

				redirect(site_url("Cliente"));
			}
		}
	}
	else{

		echo '<script type="text/javascript">alert("Inicio de sesión fallido, favor revisar los datos e intentar nuevamente")</script>';
		}
	}
}
/**
*Destruye la sesión del usuario conectado   
*/
	public function logout(){
		$llaves= array('id','usuario','privilegio','logeado');
		$this->session->unset_userdata($llaves);

		$this->session->sess_destroy();

		redirect(site_url("LoginCont"));
	}
}

