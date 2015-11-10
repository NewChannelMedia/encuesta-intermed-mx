<?php
    class Capdirecciones_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }
        public function insertDireccion($arreglo){
          return $this->db_capturista->insert('direcciones',$arreglo);
        }
        public function editarDirecciones($consultorio){
          $this->db_capturista->where('nombre',$consultorio);
          $this->db_capturista->order_by("id", "desc");
          $query = $this->db_capturista->get('direcciones');
          return $query;
        }
        public function actualizaDireccion($arreglo){
          
        }
    }
?>
