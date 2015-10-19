<?php
class Encuestam_model extends CI_Model {
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

  public function update_encuestam($id = FALSE, $data)
  {
    if ($id === FALSE){
      return FALSE;
    }

    $this->load->helper('url');

    $this->db->where('id', $id);
    return $this->db->update('encuestasM', $data);
  }

  public function get_totalEncuestasM()
  {
    $select =   array(
                'count(*) as total'
            );
    $this->db->select($select);
    $this->db->where('etapa_1', "1");
    $this->db->where('etapa_2', "1");
    $this->db->where('etapa_3', "1");
    $this->db->where('etapa_4', "1");
    $query = $this->db->get('encuestasM');
    return $query->row_array();
  }

  public function get_totalEncuestasMPorFecha()
  {
    $select =   array(
                'count(*) as total',
                'DATE(respuestasM.fecha) as fecha',
            );
    $this->db->select($select);
    $this->db->from('encuestasM');

    $this->db->where('etapa_1', "1");
    $this->db->where('etapa_2', "1");
    $this->db->where('etapa_3', "1");
    $this->db->where('etapa_4', "1");
    $this->db->join('respuestasM', 'respuestasM.encuestaM_id = encuestasM.id');

    $this->db->group_by('DATE(respuestasM.fecha)');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function create_encuestaM(){
    //Crear usuario y obtener el Id
    //Crear codigo de encuestas
    //Revisar que el codigo de la encuesta no este registrado
    //Registrar la encuesta y relacionarla con el usuario_id obtenido al inicio
  }
}
