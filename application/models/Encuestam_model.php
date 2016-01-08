<?php
class Encuestam_model extends CI_Model {
  public function __construct()
  {
      $this->db_encuesta = $this->load->database('encuesta', TRUE);
  }

  public function get_encuestasm()
  {
    $query = $this->db_encuesta->get('encuestasM');
    return $query->result_array();
  }

  public function get_encuestamByCodigo($codigo = FALSE)
  {
    if ($codigo === FALSE)
    {
      return FALSE;
    }
    $query = $this->db_encuesta->get_where('encuestasM', array('codigo' => $codigo));
    return $query->row_array();
  }

  public function get_encuestamByUsuario($usuario_id = FALSE)
  {
    if ($usuario_id === FALSE)
    {
      return FALSE;
    }
    $query = $this->db_encuesta->get_where('encuestasM', array('usuario_id' => $usuario_id));
    return $query->row_array();
  }

  public function update_encuestam($id = FALSE, $data)
  {
    if ($id === FALSE){
      return FALSE;
    }

    $this->load->helper('url');

    $this->db_encuesta->where('id', $id);
    return $this->db_encuesta->update('encuestasM', $data);
  }

  public function get_totalEncuestasM()
  {
    $select =   array(
                'count(*) as total'
            );
    $this->db_encuesta->select($select);

    $cant = 0;
    $result = $this->db_encuesta->list_fields('encuestasM');
    foreach ($result as $field) {
      if (stripos($field, 'etapa_') === 0){
        $cant++;
      }
    }

    for ($i=1; $i <= $cant; $i++) {
      $this->db_encuesta->where('etapa_'.$i, "1");
    }
    $query = $this->db_encuesta->get('encuestasM');
    return $query->row_array();
  }

  public function get_totalEncuestasMPorFecha()
  {
    $select =   array(
                'count(*) as total',
                'DATE(respuestasM.fecha) as fecha',
            );
    $this->db_encuesta->select($select);
    $this->db_encuesta->from('encuestasM');

    $cant = 0;
    $result = $this->db_encuesta->list_fields('encuestasM');
    foreach ($result as $field) {
      if (stripos($field, 'etapa_') === 0){
        $cant++;
      }
    }

    for ($i=1; $i <= $cant; $i++) {
      $this->db_encuesta->where('etapa_'.$i, "1");
    }
    $this->db_encuesta->join('respuestasM', 'respuestasM.encuestaM_id = encuestasM.id');

    $this->db_encuesta->group_by('DATE(respuestasM.fecha)');

    $query = $this->db_encuesta->get();
    return $query->result_array();
  }

  public function get_encuestamId($codigo){
    $this->db_encuesta->select('id');
    $this->db_encuesta->where('codigo', $codigo);
    $query = $this->db_encuesta->get('encuestasM');
    return $query->row_array()['id'];
  }

  public function create_encuestam($codigo,$tipoCodigo){
    $data = array('codigo'=>$codigo,'tipoCodigo'=>$tipoCodigo);
    return $this->db_encuesta->insert('encuestasM', $data);
  }

  public function delete_etapa($etapa){
    if ($etapa === FALSE){
      return FALSE;
    }

    $data = array(
      'etapa' => 0
    );

    $this->db_encuesta->where('etapa', $etapa);
    if ($this->db_encuesta->update('categorias', $data)){
        $cant = 0;
        $result = $this->db_encuesta->list_fields('encuestasM');
        foreach ($result as $field) {
          if (stripos($field, 'etapa_') === 0){
            $cant++;
          }
        }
        for ($i=$etapa+1; $i <= $cant; $i++) {
          $data = array(
            'etapa' => $i-1
          );
          $this->db_encuesta->where('etapa', $i);
          $this->db_encuesta->update('categorias', $data);
        }

        $cant = $cant-1;

        $this->db_encuesta_dbforge = $this->load->dbforge($this->db_encuesta, TRUE);
        $result = $this->db_encuesta->list_fields('encuestasM');
        foreach ($result as $field) {
          if (stripos($field, 'etapa_') === 0){
            $this->db_encuesta_dbforge->drop_column('encuestasM', $field);
          }
        }

        for ($i=1; $i <= $cant; $i++) {
          $fields = array(
            'etapa_' . $i => array('type' =>'INT','default' => 0)
          );
          $this->db_encuesta_dbforge->add_column('encuestasM', $fields);
        }
        return true;
    }
  }

  public function get_tipoEncuesta( $codigo ){
    $query = $this->db_encuesta->get_where('encuestasM', array('codigo' => $codigo));
    return $query->row_array()['tipoCodigo'];
  }
}
