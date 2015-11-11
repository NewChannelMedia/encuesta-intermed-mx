<?php
    class Captelefonos_model extends CI_Model
    {
        public function __construct(){
	          $this->db_capturista = $this->load->database('capturista', TRUE);
        }

        public function create_telefono($data){
          return $this->db_capturista->insert('telefonos', $data);
        }

        public function eliminarTelefono($id){
          return $this->db_capturista->delete('telefonos', array('id' => $id));
        }
        public function sincFon($id){
          $this->db_capturista->where('id', $id);
          $query = $this->db_capturista->get('telefonos');
          return $query->result_array();
        }
        public function traerFonsolo($id){
          $this->db_capturista->where('id',$id);
          $this->db_capturista->select('numero');
          $this->db_capturista->select('claveRegion');
          $query= $this->db_capturista->get('telefonos');
          return $query->result_array();
        }
    }
?>
