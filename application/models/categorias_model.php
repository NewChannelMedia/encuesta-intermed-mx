<?php
class Categorias_model extends CI_Model {
  public function __construct()
  {
      $this->db_encuesta = $this->load->database('encuesta', TRUE);
  }

  public function get_categorias()
  {
    $this->db_encuesta->order_by("orden", "asc");
    $query = $this->db_encuesta->get('categorias');
    return $query->result_array();
  }

  public function get_categoriasByEtapa($etapa = FALSE)
  {
    if ($etapa === FALSE)
    {
      return false;
    }
      $this->db_encuesta->order_by("orden", "asc");
    $query = $this->db_encuesta->get_where('categorias', array('etapa' => $etapa));
    return $query->result_array();
  }

  public function get_etapas(){
    $cant = 0;
    $result = $this->db_encuesta->list_fields('encuestasM');
    foreach ($result as $field) {
      if (stripos($field, 'etapa_') === 0){
        $cant++;
      }
    }
    return $cant;
  }

  public function set_etapas($cant){
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
  }

  public function create_categoria($categoria){
    $data = array(
     'categoria' => $categoria ,
     'etapa' => 0
    );
    return $this->db_encuesta->insert('categorias', $data);
  }

  public function delete_categoria($categoria_id){
    if ($categoria_id === FALSE){
      return FALSE;
    }
    $data = array(
      'categoria_id'=>0
    );
    $result = false;
    $this->db_encuesta->where('categoria_id', $categoria_id);
    if ( $this->db_encuesta->update('preguntasM', $data)){
      $result = $this->db_encuesta->delete('categorias', array('id' => $categoria_id));
    }
    $this->actualizarNumPreg();
    return $result;
  }

  public function update_etapaCategoria($categoria_id = FALSE,$etapa=FALSE, $orden){
    if ($categoria_id === FALSE || $etapa === FALSE){
      return FALSE;
    }
    $data = array(
      'etapa'=>$etapa,
      'orden'=> $orden
    );
    $result = false;
    $this->db_encuesta->where('id', $categoria_id);
    $result = $this->db_encuesta->update('categorias', $data);
    $this->actualizarNumPreg();
    return $result;
  }

  public function mdate($format, $microtime = null) {
        $microtime = explode(' ', ($microtime ? $microtime : microtime()));
        if (count($microtime) != 2) return false;
        $microtime[0] = $microtime[0] * 1000000;
        $format = str_replace('u', $microtime[0], $format);
        return date($format, $microtime[1]);
    }


    public function existe_etapa($etapa){
      $existe = false;
      $result = $this->db_encuesta->list_fields('encuestasM');
      foreach ($result as $field) {
        if ($field == "etapa_".$etapa){
          $existe = true;
        }
      }
      return $existe;
    }

    public function actualizarNumPreg(){
      $this->db_encuesta->order_by("orden", "asc");
      $this->db_encuesta->where('id >', 0);
      $this->db_encuesta->where('etapa >', 0);
      $categorias = $this->db_encuesta->get('categorias')->result_array();

      $indice = 1;
      $dat = array(
        'numPreg' => null
      );
      $query = $this->db_encuesta->update('preguntasM', $dat);
      foreach ($categorias as $categoria) {
        $this->db_encuesta->order_by("id", "asc");
        $this->db_encuesta->where('categoria_id', $categoria['id']);
        $preguntas = $this->db_encuesta->get('preguntasM')->result_array();
        foreach ($preguntas as $pregunta) {
            $dat = array(
              'numPreg' => $indice++
            );
            $this->db_encuesta->where('id', $pregunta['id']);
            $query = $this->db_encuesta->update('preguntasM', $dat);
        }
      }
    }

}
