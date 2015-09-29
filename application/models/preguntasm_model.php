<?php
class PreguntasM_Model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_preguntam()
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
    return $query->row_array();
  }

  public function get_preguntamByEtapa($etapa = FALSE)
  {
    if ($etapa === FALSE)
    {
      return false;
    }
    $query = $this->db->get_where('preguntasM', array('etapa' => $etapa));
    return $query->row_array();
  }
}
