<?php
    class Captelefonos_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }

        public function create_telefono($data){
          return $this->db_capturista->insert('telefonos', $data);
        }

    }
?>
