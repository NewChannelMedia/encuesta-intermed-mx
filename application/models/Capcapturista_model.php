<?php
  class Capcapturista_model extends CI_Model
  {
    public function __construct(){
        $this->db_capturista = $this->load->database('capturista', TRUE);
    }
    public function insertDatosCapturista($id,$nombre,$apellido,$correo){
      $data = array(
        'id_master' => $id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo
      );
      if( $this->db_capturista->insert('capturista', $data) ){
        return true;
      }else{
        return false;
      }
    }
    public function getDatosNombres($id){
      $this->db_capturista->where('id_master',$id);
      $query = $this->db_capturista->get('capturista');
      return $query;
    }
  }
?>
