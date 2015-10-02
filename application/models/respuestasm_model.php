<?php
class RespuestasM_Model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_respuestam()
  {
    $query = $this->db->get('respuestasM');
    return $query->result_array();
  }

  public function get_respuestamByPregunta($preguntasM_id = FALSE)
  {
    if ($preguntasM_id === FALSE)
    {
      return FALSE;
    }
    $query = $this->db->get_where('respuestasM', array('preguntaM_id' => $preguntasM_id));
    return $query->row_array();
  }

  public function get_respuestamByEncuesta($encuestasM_id = FALSE)
  {
    if ($encuestasM_id === FALSE)
    {
      return FALSE;
    }
    $query = $this->db->get_where('respuestasM', array('encuestasM_id' => $encuestasM_id));
    return $query->row_array();
  }

  public function get_respuestamByEncuestaEtapa($encuestasM_id = FALSE, $etapa = FALSE)
  {
    if ($encuestasM_id === FALSE  || $etapa === FALSE)
    {
      return FALSE;
    }
    $query = $this->db->get_where('preguntasM', array('etapa' => $etapa));
    $preguntas = array();
    foreach ($query->row_array() as $pregunta) {
      $preguntas[] = $pregunta.id;
    }
    $this->db->where_in('preguntasM_id', $preguntas);
    $query = $this->db->get('respuestasM');
    return $query->row_array();
  }

  public function update_respuestamByEncuesta($encuestaM_id = FALSE, $data = FALSE)
  {
    if ($encuestaM_id === FALSE || $data === FALSE)
    {
      return FALSE;
    }

    $query = $this->db->get_where('respuestasM', array('encuestaM_id' => $encuestaM_id));
    $result = $query->row_array();

    if (!$result){
      $this->db->set('encuestaM_id', $encuestaM_id);
      $this->db->insert('respuestasM');
    }

    $this->db->where('encuestaM_id', $encuestaM_id);
    return $this->db->update('respuestasM', $data);

  }


  public function get_respuestaByEncuestaPregunta($encuestasM_id = FALSE, $pregunta_id = FALSE)
  {
    if ($encuestasM_id === FALSE || $pregunta_id === FALSE)
    {
      return FALSE;
    }
    $this->db->select('pregunta_' . $pregunta_id);
    $query = $this->db->get_where('respuestasM', array('encuestaM_id' => $encuestasM_id));
    return $query->row_array();
  }
}
