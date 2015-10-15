<?php
  class Contacto_model extends CI_Model
  {
    //constructor
    function __construct(){
      $this->load->database();
    }

    public function get_totalNuevos(){
      $select =   array(
                  'count(*) as total'
              );
      $this->db->select($select);
      $this->db->where('leido', 0);
      $query = $this->db->get('contacto');
      return $query->row_array();
    }

    //metodos para las inserciones
    public function insertData($data){
      //objecto para insertar a la tabla
      return $this->db->insert('contacto', $data);
    }

    public function get_mensajes(){
        $this->db->order_by("id", "asc");
        $query = $this->db->get('contacto');
        return $query->result_array();
    }

    public function set_leidos(){
        $this->db->where('leido', 0);
        $query = $this->db->update('contacto', array('leido'=>1));
        return $query;
    }

    public function set_respuesta($id,$respuesta){
        $this->db->where('id', $id);
        $query = $this->db->update('contacto', array('respuesta'=>$respuesta));
        return $query;
    }

  }
?>
