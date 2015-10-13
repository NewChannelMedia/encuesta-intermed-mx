<?php
class Newsletter_model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_newsletter()
  {
    $query = $this->db->get('newsletter');
    return $query->result_array();
  }

  public function create_newsletter($nombre = FALSE, $correo = FALSE, $news = FALSE, $pruebas = FALSE)
  {
    if ($nombre === FALSE || $correo === FALSE || $news === FALSE || $pruebas === FALSE)
    {
      return false;
    }

    $query = $this->db->get_where('newsletter', array('correo' => $correo));
    $result = $query->row_array();

    if ($result) return $result;
    else {
      $this->db->set('nombre', $nombre);
      $this->db->set('correo', $correo);
      $this->db->set('news', $news);
      $this->db->set('pruebas', $pruebas);
      return $this->db->insert('newsletter');
    }
  }
}
