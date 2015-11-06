<?php
    class Capmedicos_telefonos extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }

    }
?>
