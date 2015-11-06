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

    }
?>
