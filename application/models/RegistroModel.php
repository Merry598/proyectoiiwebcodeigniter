<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroModel extends CI_Model{

    function __construct(){
        parent:: __construct();
        $this->load->database();
    }
    /**
      *Verifica que el nombre de usuario sea el correcto y que en el registro no se encuentre ya ocupado
      *
      * @$nombreUsuario Nombre de usuario a verificar
      * y return Cantidad de usuarios con ese nombre, de no haber ninguno el retorno de la función será de cero
      */
    public function verificarExistenciaNombreUsuario(string $nombreUsuario){
        
        $query = $this->db->get_where('usuarios', array('nombre_usuario' => $nombreUsuario));

        if($query){
            return $this->db->affected_rows();
        }
}
    
    /**
     * Inserta un nuevo cliente en DB
     *conlos datos solicitados en el frm
    
     * y return true si lo guarda, false si no
     */
    public function guardar(string $nombre,string $primerApellido,string $segundoApellido,string $telefono,string $correo,
    string $direccion,string $nombreUsuario,string $contrasenna){

        
        $query = $this->db->insert("usuarios",array("nombre"=> $nombre,"primer_apellido"=> $primerApellido,"segundo_apellido"=>$segundoApellido,
        "telefono"=>$telefono,"correo"=>$correo,"direccion"=>$direccion,"contrasenna"=>$contrasenna,"privilegio"=>'0',
        "nombre_usuario"=>$nombreUsuario ));

            if ($query) {
                return true;
            } else {
                return false;
            }

        }

    }