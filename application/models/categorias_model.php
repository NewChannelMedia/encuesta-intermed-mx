<?php
class Categorias_model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_categorias()
  {
    $this->db->select('id');
    $this->db->select('categoria');
    $this->db->order_by("id", "asc");
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
