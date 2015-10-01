<?php
class Categorias_Model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_categorias()
  {
    $query = $this->db->get('categorias');
    return $query->result_array();
  }

  public function get_categoriasByEtapa($etapa = FALSE)
  {
    if ($etapa === FALSE)
    {
      return false;
    }
    $query = $this->db->get_where('categorias', array('etapa' => $etapa));
    return $query->result_array();
  }
}
