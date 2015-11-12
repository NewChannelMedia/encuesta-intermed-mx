<?php
  /**
  * Modelo para la insercion a la db capturista
  *
  *
  *
  **/
  class Capturista_model extends CI_Model
  {
    // constructor
    public function __construct(){
      // carga la base de datos encuesta
      $this->db_encuesta = $this->load->database('encuesta', TRUE);
    }
    /**
    * la siguiente funcion inserta el usuario y password
    * que se mandan por medio de ajax atravez de la vista al controlador
    * hasta el modelo.
    * @param usuario: nombre del usuario
    * @param password: password del usuario
    **/
    public function usuarioPassword( $usuario, $password){
      // arreglo que se manda para hacer la insercion
      $data = array(
        'usuario' => $usuario,
        'password' => $password,
        'rol' => 'capturista'
      );
      if( $this->db_encuesta->insert('master', $data) ){
        return true;
      }else{
        return false;
      }
    }
  }
?>
