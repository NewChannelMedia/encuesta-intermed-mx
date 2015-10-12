<?php
  class Porvalidar_model extends CI_Model
  {
    //constructor
    function __construct(){
      $this->load->database();
    }

    //metodos para las inserciones
    public function insertData( $nombre, $correo, $medico, $cedula, $justificacion ){
      //objecto para insertar a la tabla
      $obj = array(
        'nombre' => $nombre,
        'correo'=> $correo,
        'medico'=> $medico,
        'cedula'=> $cedula,
        'justificacion'=> $justificacion,
        'status'=>0
      );
      return $this->db->insert('porValidar', $obj);
    }

    public function updateData( $condicion, $nombre, $cedula ){
      $object = array('nombre'=>$nombre,'cedula'=>$cedula, 'medico' => 1);
      $this->db->where('correo', $condicion);
      $this->db->update('porValidar',$object);
      return true;
    }

    public function usuarioInsert($condicion, $nombre, $justificacion ){
      $obj = array(
        'nombre' => $nombre,
        'justificacion'=> $justificacion
      );
      $this->db->where('correo', $condicion);
      $this->db->update('porValidar', $obj);
      return true;
    }
    /**
    * function para actualizar el status del usuario aceptado o rechazado
    * @param $correo para la condicion
    */
    public function actualizaStatus($correo, $id){
      $obj = array('status'=>1);
      $this->db->where('id',$id);
      $this->db->where('correo',$correo);
      $this->db->update('porValidar',$obj);
    }
    public function negado($correo, $id){
      $obj= array('status'=>2);
      $this->db->where('id',$id);
      $this->db->where('correo',$correo);
      $this->db->update('porValidar',$obj);
    }
  }
?>
