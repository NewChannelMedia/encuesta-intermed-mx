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

        public function update_medico($medico_id,$correo){
          $data = array(
                         'correo' => $correo
                      );

          $this->db_capturista->where('id', $medico_id);
          return $this->db_capturista->update('medicos', $data);
        }

        /**
        * funcion para actualizar los datos generales del medico
        * @param array, este arreglo traera todos los inputs para su actualizacion
        * @param medico_id este campo sera la condicion para el update
        **/
        public function updateMedico($arreglo, $medico_id){
          $this->db_capturista->where('id',$medico_id);
          $this->db_capturista->update('medicos',$arreglo);
        }
        public function get_medico($medico_id){
          $medico = array();
          $this->db_capturista->where('id',$medico_id);
          $medico['medico'] = $this->db_capturista->get('medicos')->row_array();
          $this->db_capturista->where('id',$medico['medico']['especialidad_id']);
          $medico['especialidad'] = $this->db_capturista->get('especialidades')->row_array();
          $this->db_capturista->where('medico_id', $medico_id);
          $medico['telefonos'] = $this->db_capturista->get('telefonos')->result_array();
          $this->db_capturista->where('medico_id', $medico_id);
          $medico['direcciones'] = $this->db_capturista->get('direcciones')->result_array();

          for ($i=0; $i < count($medico['direcciones']); $i++) {
            //Estado
            $estado_id = $medico['direcciones'][$i]['estado'];
            $this->db_capturista->where('id', $estado_id);
            $medico['direcciones'][$i]['estado'] = $this->db_capturista->get('estados')->row_array()['estado'];
            $medico['direcciones'][$i]['estado_id'] = $estado_id;
            //Municipio
            $municipio_id = $medico['direcciones'][$i]['municipio'];
            $this->db_capturista->where('estado_id', $estado_id);
            $this->db_capturista->where('id', $municipio_id);
            $medico['direcciones'][$i]['municipio'] = $this->db_capturista->get('municipios')->row_array()['municipio'];
            $medico['direcciones'][$i]['municipio_id'] = $municipio_id;
            //Localidad
            $localidad_id = $medico['direcciones'][$i]['localidad'];
            $this->db_capturista->where('id', $localidad_id);
            $medico['direcciones'][$i]['localidad'] = $this->db_capturista->get('localidades')->row_array()['localidad'];
            $medico['direcciones'][$i]['localidad_id'] = $localidad_id;
            //echo 'LOCALIDAD: '  . $medicos['direcciones'][$i]['localidad'] .'<br/>';
          }
          return $medico;
        }

        public function terminar_captura($id){
          $data = array(
                         'terminado' => 1
                      );
          $this->db_capturista->where('id', $id);
          return $this->db_capturista->update('medicos', $data);

        }

    }
?>
