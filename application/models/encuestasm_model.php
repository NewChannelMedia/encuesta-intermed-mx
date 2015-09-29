<?php
class EncuestasM_Model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_encuestasm()
  {
    $query = $this->db->get('encuestasM');
    return $query->result_array();
  }

  public function get_encuestamByCodigo($codigo = FALSE)
  {
    if ($codigo === FALSE)
    {
      return FALSE;
    }
    $query = $this->db->get_where('encuestasM', array('codigo' => $codigo));
    return $query->row_array();
  }

  public function get_encuestamByUsuario($usuario_id = FALSE)
  {
    if ($usuario_id === FALSE)
    {
      return FALSE;
    }
    $query = $this->db->get_where('encuestasM', array('usuario_id' => $usuario_id));
    return $query->row_array();
  }

  public function create_encuestaM(){
    //Crear usuario y obtener el Id
    //Crear codigo de encuestas
    //Revisar que el codigo de la encuesta no este registrado
    //Registrar la encuesta y relacionarla con el usuario_id obtenido al inicio
  }
}
