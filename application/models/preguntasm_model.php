<?php
class Preguntasm_model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_preguntasm()
  {
    $query = $this->db->get('preguntasM');
    return $query->result_array();
  }

  public function get_preguntam($id = FALSE)
  {
    if ($id === FALSE)
    {
      return false;
    }
    $query = $this->db->get_where('preguntasM', array('id' => $id));
    return $query->result_array();
  }

  public function get_preguntamByCategoria($categoria_id = FALSE)
  {
    if ($categoria_id === FALSE)
    {
      return false;
    }
    $this->db->order_by("id", "asc");
    $query = $this->db->get_where('preguntasM', array('categoria_id' => $categoria_id));
    return $query->result_array();
  }
}
