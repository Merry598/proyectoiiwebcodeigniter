<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginVerificator extends CI_Model{

    function __construct(){
        parent:: __construct();
        $this->load->database();
     }

     public function validarDatos(string $usuario, string $contrasenna){
        $query = $this->db->get_where('usuarios', array('nombre_usuario' => $usuario));
    
        if ($query->result()) {
            return $query->result();
          } else {
            return false;
          }
     }

}