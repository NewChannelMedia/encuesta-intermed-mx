<?php
class Newsletter_model extends CI_Model {
  public function __construct()
  {
      $this->db_encuesta = $this->load->database('encuesta', TRUE);
  }

  public function get_newsletter()
  {
    $query = $this->db_encuesta->get('newsletter');
    return $query->result_array();
  }

  public function create_newsletter($nombre = FALSE, $correo = FALSE, $news = FALSE, $pruebas = FALSE)
  {
    if ($nombre === FALSE || $correo === FALSE || $news === FALSE || $pruebas === FALSE)
    {
      return false;
    }

    $query = $this->db_encuesta->get_where('newsletter', array('correo' => $correo));
    $result = $query->row_array();

    if ($result) return $result;
    else {
      $this->db_encuesta->set('nombre', $nombre);
      $this->db_encuesta->set('correo', $correo);
      $this->db_encuesta->set('news', $news);
      $this->db_encuesta->set('pruebas', $pruebas);
      return $this->db_encuesta->insert('newsletter');
    }
  }


  public function get_totalNewsletter()
  {
    $select =   array(
                'count(*) as total'
            );
    $this->db_encuesta->select($select);
    $query = $this->db_encuesta->get('newsletter');
    return $query->row_array();
  }
}
