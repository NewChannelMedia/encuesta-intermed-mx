<?php
    class Capubicaciones_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }

        public function get_estados(){
          return $this->db_capturista->get('estados')->result_array();
        }

        public function get_municipios($estado_id){
          $query = 'SELECT municipios.*,estados.estado FROM municipios,estados where municipios.estado_id = estados.id AND estados.id = "' . $estado_id . '";';
          $result = $this->db_capturista->query($query);
          return $result->result_array();
        }

        public function get_localidades($estado_id,$municipio_id){
          $query = 'SELECT localidades.*,estados.estado,municipios.municipio FROM municipios,estados,localidades where localidades.estado_id = estados.id AND localidades.municipio_id = municipios.id AND estados.id = "' . $estado_id . '"  AND municipios.id = "' . $municipio_id . '" AND municipios.estado_id = estados.id ORDER BY localidades.localidad ASC;';
          $result = $this->db_capturista->query($query);
          return $result->result_array();
        }

        public function get_localidad($id){
          $result = $this->db_capturista->where('id',$id);
          $result = $this->db_capturista->get('localidades');
          return $result->result_array();
        }
    }
?>
