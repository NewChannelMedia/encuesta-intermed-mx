<?php
class Respuestasm_model extends CI_Model {
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
    $select =   array(
                'pregunta_'.$preguntasM_id.' as respuesta',
                'count(pregunta_'.$preguntasM_id.') as total'
            );

    $cant = 0;
    $result = $this->db->list_fields('encuestasM');
    foreach ($result as $field) {
      if (stripos($field, 'etapa_') === 0){
        $cant++;
      }
    }
    $where = '';
    for ($i=1; $i <= $cant; $i++) {
      $where .= ' and etapa_'.$i .'= "1" ';
    }

    $this->db->select('pregunta_'.$preguntasM_id.' as "respuesta", count(pregunta_'.$preguntasM_id.') as "total" FROM respuestasM,encuestasM WHERE  respuestasM.encuestaM_id = encuestasM.id'.$where, FALSE);

    $this->db->group_by('pregunta_'.$preguntasM_id);
    $query = $this->db->get();
    return $query->result_array();
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

  public function get_dispositivos()
  {
    $this->db->select('SUBSTRING(pregunta_12,24) AS "dispositivo", COUNT(*) AS "total" FROM respuestasM WHERE LENGTH(pregunta_12) > 3', FALSE);
    $this->db->group_by('SUBSTRING(pregunta_12,24)');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_ejecutarConsulta($query){
    $query = $this->db->query($query);
    return $query->row_array();
  }
}
