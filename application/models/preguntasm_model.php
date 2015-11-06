<?php
class Preguntasm_model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_preguntasm()
  {
    $this->db->select('preguntasM.id, preguntasM.pregunta,preguntasM.tipo,preguntasM.opciones,preguntasM.categoria_id,categorias.categoria FROM preguntasM,categorias WHERE preguntasM.categoria_id = categorias.id ORDER BY categorias.orden', FALSE);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_preguntam($id = FALSE)
  {
    if ($id === FALSE)
    {
      return false;
    }
    $query = $this->db->get_where('preguntasM', array('id' => $id));
    return $query->row_array();
  }

  public function get_preguntamByCategoria($categoria_id = FALSE)
  {
    if ($categoria_id === FALSE)
    {
      return false;
    }
    $this->db->order_by("id", "asc");
    $query = $this->db->get_where('preguntasM', array('categoria_id' => $categoria_id));
    return $query->result_array();
  }

  public function create_pregunta($data)
  {
    $this->load->dbforge();
    $this->db->set('pregunta', $data['pregunta']);
    $this->db->set('tipo', $data['tipo']);
    $this->db->set('opciones', $data['opciones']);
    $this->db->set('categoria_id', $data['categoria_id']);
    if ($this->db->insert('preguntasM')){
      $this->db->order_by('id desc');
      $this->db->limit(1);
      $query =$this->db->get('preguntasM');
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
    $this->db->where('id', $data['pregunta_id']);
    $query = $this->db->update('preguntasM', $dat);
    return $query;
  }

  public function delete_pregunta($data){
    $this->load->dbforge();
    $result = $this->db->delete('preguntasM', $data);
    if ($result){
      $result = $this->db->list_fields('respuestasM');
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
