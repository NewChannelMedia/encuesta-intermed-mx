<?php
  class PorValidar_model extends CI_Model
  {
    //constructor
    function __construct(){
        $this->db_encuesta = $this->load->database('encuesta', TRUE);
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
      return $this->db_encuesta->insert('porValidar', $obj);
    }

    public function updateData( $condicion, $nombre, $cedula ){
      $object = array('nombre'=>$nombre,'cedula'=>$cedula, 'medico' => 1);
      $this->db_encuesta->where('correo', $condicion);
      $this->db_encuesta->update('porValidar',$object);
      return true;
    }

    public function usuarioInsert($condicion, $nombre, $justificacion ){
      $obj = array(
        'nombre' => $nombre,
        'justificacion'=> $justificacion
      );
      $this->db_encuesta->where('correo', $condicion);
      $this->db_encuesta->update('porValidar', $obj);
      return true;
    }
    /**
    * function para actualizar el status del usuario aceptado o rechazado
    * @param $correo para la condicion
    */
    public function actualizaStatus($correo, $id){
      $obj = array('status'=>1);
      $this->db_encuesta->where('id',$id);
      $this->db_encuesta->where('correo',$correo);
      $this->db_encuesta->update('porValidar',$obj);
    }
    public function negado($correo,$id){
      $obj= array('status'=>2);
      $this->db_encuesta->where('id',$id);
      $this->db_encuesta->where('correo',$correo);
      $this->db_encuesta->update('porValidar',$obj);
    }

    public function get_totalPorValidar()
    {
      $select =   array(
                  'count(*) as total'
              );
      $this->db_encuesta->select($select);
      $this->db_encuesta->where('status', "0");
      $query = $this->db_encuesta->get('porValidar');
      return $query->row_array();
    }

    public function get_totalAceptados()
    {
      $select =   array(
                  'count(*) as total'
              );
      $this->db_encuesta->select($select);
      $this->db_encuesta->where('status', "1");
      $query = $this->db_encuesta->get('porValidar');
      return $query->row_array();
    }

    public function get_totalRechazados()
    {
      $select =   array(
                  'count(*) as total'
              );
      $this->db_encuesta->select($select);
      $this->db_encuesta->where('status', "2");
      $query = $this->db_encuesta->get('porValidar');
      return $query->row_array();
    }
    public function insertMensaje($id,$mensaje){
      $obj = array('mensaje'=>$mensaje);
      $this->db_encuesta->where('id',$id);
      $this->db_encuesta->update('porValidar',$obj);
    }

    public function insertarEnvioDirecto( $nombre, $correo){
      //objecto para insertar a la tabla
      $obj = array(
        'nombre' => $nombre,
        'correo'=> $correo,
        'status'=>2
      );
      return $this->db_encuesta->insert('porValidar', $obj);
    }

    public function insertarEnvioRecomendado( $nombre, $correo,$mensaje){
      //objecto para insertar a la tabla
      $obj = array(
        'nombre' => $nombre,
        'correo'=> $correo,
        'justificacion'=>$mensaje,
        'status'=>3
      );
      return $this->db_encuesta->insert('porValidar', $obj);
    }

  }
?>
