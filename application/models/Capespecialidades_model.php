<?php
    class Capespecialidades_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }

        public function get_especialidades(){
            $query = $this->db_capturista->get('especialidades');
            return $query->result_array();
        }

        public function get_especialidadId($especialidad){
          $query = $this->db_capturista->get_where('especialidades', array('especialidad' => $especialidad));
          return $query->row_array()['id'];
        }

        public function create_especialidad($especialidad){
            $data = array('especialidad'=>$especialidad,'agregado'=>1);
            if($this->db_capturista->insert('especialidades', $data)){
              $this->db_capturista->select('id');
              $this->db_capturista->order_by("id", "desc");
              $this->db_capturista->limit(1);
              $result = $this->db_capturista->get('especialidades');
              if (count($result->row_array())>0){
                $id= $result->row_array()['id'];
              } else {
                $id = false;
              }
              return $id;
            } else {
              return false;
            }
        }

    }
?>
