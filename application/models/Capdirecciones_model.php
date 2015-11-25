<?php
    class Capdirecciones_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }
        public function insertDireccion($arreglo){
          return $this->db_capturista->insert('direcciones',$arreglo);
        }
        public function editarDirecciones($medico_id){
          $this->db_capturista->where('medico_id',$medico_id);
          $this->db_capturista->order_by("id", "desc");
          $query = $this->db_capturista->get('direcciones',1);
          return $query;
        }
        public function actualizaDireccion($id,$arreglo){
          $this->db_capturista->where('id',$id);
          $this->db_capturista->update('direcciones',$arreglo);
        }
        public function ponerNombre($id){
          $this->db_capturista->where('id',$id);
          $this->db_capturista->select('nombre');
          $nombre = $this->db_capturista->get('direcciones');
          return $nombre;
        }
        public function anadirFon($numero){
          $this->db_capturista->where('medico_id',$numero);
          $this->db_capturista->order_by("id", "desc");
          $query = $this->db_capturista->get('telefonos',1);
          return $query;
        }
        public function actualizarFon($id, $arreglo ){
          $this->db_capturista->where('id', $id);
          return $this->db_capturista->update('telefonos', $arreglo);
        }

        public function eliminarDireccion($id){
          return $this->db_capturista->delete('direcciones', array('id' => $id));
        }

    }
?>
