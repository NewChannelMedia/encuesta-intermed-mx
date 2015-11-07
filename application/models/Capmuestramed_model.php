<?php
    class Capmuestramed_model extends CI_Model
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

        public function get_countMuestra(){
          $this->db_capturista->select('count(*) AS "count"');
          $result = $this->db_capturista->get('muestraMedicos');
          return $result->row_array()['count'];
        }

        public function get_muestra(){
          $muestra = array();
          $result = $this->db_capturista->get('muestraMedicos',500);
          $result = $result->result_array();
          foreach ($result as $muestraMedico) {
            $medico = array();
            $medico['muestra_id'] = $muestraMedico['id'];
            $this->db_capturista->where('id', $muestraMedico['medico_id']);
            $medico['medico'] = $this->db_capturista->get('medicos')->row_array();
            $this->db_capturista->where('medico_id', $muestraMedico['medico_id']);
            $medico['telefonos'] = $this->db_capturista->get('telefonos')->result_array();
            $this->db_capturista->where('medico_id', $muestraMedico['medico_id']);
            $medico['direcciones'] = $this->db_capturista->get('direcciones')->result_array();


            $muestra[] = $medico;
          }
          return $muestra;
        }

        public function get_minIdMedicos(){
          $this->db_capturista->select('min(id) AS "id"');
          $min = $this->db_capturista->get('medicos');
          $min = $min->row_array()['id'];
          return $min;
        }

        public function get_maxIdMedicos(){
          $this->db_capturista->select('max(id) AS "id"');
          $max = $this->db_capturista->get('medicos');
          $max = $max->row_array()['id'];
          return $max;
        }

        public function create_muestra($min,$max){
          $id = array();
          for ($i=0; $i < 1000; $i++) {
            $random = rand($min,$max);
            while(in_array($random,$id)){
              $random = rand($min,$max);
            }
            $id[] = $random;
            $this->db_capturista->insert('muestraMedicos', array('medico_id'=>$random));
          }
          return true;
        }

    }
?>
