<?php
class Preguntasm_model extends CI_Model {
  public function __construct()
  {
      $this->db_encuesta = $this->load->database('encuesta', TRUE);
  }

  public function get_preguntasm()
  {
    $this->db_encuesta->select('preguntasM.id, preguntasM.pregunta,preguntasM.tipo,preguntasM.opciones,preguntasM.categoria_id,categorias.categoria FROM preguntasM,categorias WHERE preguntasM.categoria_id = categorias.id ORDER BY categorias.orden', FALSE);
    $query = $this->db_encuesta->get();
    return $query->result_array();
  }

  public function get_preguntam($id = FALSE)
  {
    if ($id === FALSE)
    {
      return false;
    }
    $query = $this->db_encuesta->get_where('preguntasM', array('id' => $id));
    return $query->row_array();
  }

  public function get_preguntamByCategoria($categoria_id = FALSE)
  {
    if ($categoria_id === FALSE)
    {
      return false;
    }
    $this->db_encuesta->order_by("id", "asc");
    $query = $this->db_encuesta->get_where('preguntasM', array('categoria_id' => $categoria_id));
    return $query->result_array();
  }

  public function create_pregunta($data)
  {
    $this->load->dbforge();
    $this->db_encuesta->set('pregunta', $data['pregunta']);
    $this->db_encuesta->set('tipo', $data['tipo']);
    $this->db_encuesta->set('opciones', $data['opciones']);
    $this->db_encuesta->set('categoria_id', $data['categoria_id']);
    if ($this->db_encuesta->insert('preguntasM')){
      $this->db_encuesta->order_by('id desc');
      $this->db_encuesta->limit(1);
      $query =$this->db_encuesta->get('preguntasM');
      $query = $query->row_array();
      $fields = array(
        'pregunta_' . $query['id'] => array('type' => 'TEXT')
      );
      $result = $this->dbforge->add_column('respuestasM', $fields);
      return array('id'=>$query['id'],'result'=>$result);
    }
  }

  public function update_pregunta($data)
  {
    $dat = array(
      'pregunta' => $data['pregunta'],
      'tipo' => $data['tipo'],
      'opciones' => $data['opciones'],
      'categoria_id' => $data['categoria_id'],
    );
    $this->db_encuesta->where('id', $data['pregunta_id']);
    $query = $this->db_encuesta->update('preguntasM', $dat);
    return $query;
  }

  public function delete_pregunta($data){
    $this->load->dbforge();
    $result = $this->db_encuesta->delete('preguntasM', $data);
    if ($result){
      $result = $this->db_encuesta->list_fields('respuestasM');
      $existe = false;
      foreach($result as $field)
      {
        if ($field == "pregunta_" . $data['id']){
          $existe = true;
        }
      }
      if ($existe){
        $this->dbforge->drop_column('respuestasM', 'pregunta_' . $data['id']);
      }

      return true;
    }
    else return false;
  }
}
