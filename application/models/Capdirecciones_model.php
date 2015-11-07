<?php
    class Capdirecciones_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }
        public function insertDireccion($arreglo){
          return $this->db_capturista->insert('direcciones',$arreglo);
        }
    }
?>
