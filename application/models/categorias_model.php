<?php
class Categorias_model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_categorias()
  {
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

  public function get_etapas(){
    $cant = 0;
    $result = $this->db->list_fields('encuestasM');
    foreach ($result as $field) {
      if (stripos($field, 'etapa_') === 0){
        $cant++;
      }
    }
    return $cant;
  }

  public function set_etapas($cant){
    $this->load->dbforge();
    $result = $this->db->list_fields('encuestasM');
    foreach ($result as $field) {
      if (stripos($field, 'etapa_') === 0){
        $this->dbforge->drop_column('encuestasM', $field);
      }
    }

    for ($i=1; $i <= $cant; $i++) {
      $fields = array(
        'etapa_' . $i => array('type' =>'INT','default' => 0)
      );
      $this->dbforge->add_column('encuestasM', $fields);
    }
  }

  public function create_categoria($categoria){
    $data = array(
     'categoria' => $categoria ,
     'etapa' => 0
    );

    return $this->db->insert('categorias', $data);
  }

  public function delete_categoria($categoria_id){
    if ($categoria_id === FALSE){
      return FALSE;
    }
    $data = array(
      'categoria_id'=>0
    );
    $result = false;
    $this->db->where('categoria_id', $categoria_id);
    if ( $this->db->update('preguntasM', $data)){
      $result = $this->db->delete('categorias', array('id' => $categoria_id));
    }
    return $result;
  }

}
