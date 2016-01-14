<?php
  class Contacto_model extends CI_Model
  {
    //constructor
    function __construct(){
        $this->db_encuesta = $this->load->database('encuesta', TRUE);
    }

    public function get_totalNuevos(){
      $select =   array(
                  'count(*) as total'
              );
      $this->db_encuesta->select($select);
      $this->db_encuesta->where('leido', 0);
      $query = $this->db_encuesta->get('contacto');
      return $query->row_array();
    }

    //metodos para las inserciones
    public function insertData($data){
      //objecto para insertar a la tabla
      return $this->db_encuesta->insert('contacto', $data);
    }

    public function get_mensajes(){
        $this->db_encuesta->order_by("id", "asc");
        $query = $this->db_encuesta->get('contacto');
        return $query->result_array();
    }

    public function set_leidos(){
        $this->db_encuesta->where('leido', 0);
        $query = $this->db_encuesta->update('contacto', array('leido'=>1));
        return $query;
    }

    public function set_respuesta($id,$respuesta){
        $this->db_encuesta->where('id', $id);
        $query = $this->db_encuesta->update('contacto', array('respuesta'=>$respuesta));
        return $query;
    }

  }
?>
