<?php
    class Capmedicos_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }

        public function create_medico($data = array()){
          if (count($data) == 0){
            return false;
          }
          if($this->db_capturista->insert('medicos', $data)){
            $this->db_capturista->select('id');
            $this->db_capturista->order_by("fecha", "desc");
            $this->db_capturista->limit(1);
            $result = $this->db_capturista->get('medicos');
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
