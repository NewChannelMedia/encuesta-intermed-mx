<?php
    class Capmuestramed_model extends CI_Model
    {
        public function __construct(){
            $this->db_encuesta = $this->load->database('encuesta', TRUE);
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

        public function get_countMuestra_llamadas(){
          $this->db_capturista->select('count(*) AS "count"');
          $result = $this->db_capturista->get_where('muestraMedicos',array('tipoCanal'=>1));
          return $result->row_array()['count'];
        }
        public function get_muestra_correosM(){
          $this->db_capturista->select('count(*) AS "count"');
          $result = $this->db_capturista->get_where('muestraMedicos',array('tipoCanal'=>3));
          return $result->row_array()['count'];
        }
        public function get_muestra_llamadas(){
          $muestra = array();
          $result = $this->db_capturista->get_where('muestraMedicos',array('tipoCanal'=>1,'aut<='=>1),500);
          $result = $result->result_array();
          foreach ($result as $muestraMedico) {
            $medico = array();
            $medico['muestra_id'] = $muestraMedico['id'];
            $medico['aut'] = $muestraMedico['aut'];
            $medico['posponer'] = $muestraMedico['posponer'];
            $this->db_capturista->where('id', $muestraMedico['medico_id']);
            $medico['medico'] = $this->db_capturista->get('medicos')->row_array();
            $this->db_capturista->where('id',$medico['medico']['especialidad_id']);
            $medico['especialidad'] = $this->db_capturista->get('especialidades')->row_array();
            $this->db_capturista->where('medico_id', $muestraMedico['medico_id']);
            $medico['telefonos'] = $this->db_capturista->get('telefonos')->result_array();
            $this->db_capturista->where('medico_id', $muestraMedico['medico_id']);
            $medico['direcciones'] = $this->db_capturista->get('direcciones')->result_array();

            for ($i=0; $i < count($medico['direcciones']); $i++) {
              //Estado
              $estado_id = $medico['direcciones'][$i]['estado'];
              $this->db_capturista->where('id', $estado_id);
              $medicos['direcciones'][$i]['estado'] = $this->db_capturista->get('estados')->row_array()['estado'];
              //Municipio
              $municipio_id = $medico['direcciones'][$i]['municipio'];
              $this->db_capturista->where('estado_id', $estado_id);
              $this->db_capturista->where('id', $municipio_id);
              $medicos['direcciones'][$i]['municipio'] = $this->db_capturista->get('municipios')->row_array()['municipio'];
              //Localidad
              $localidad_id = $medico['direcciones'][$i]['localidad'];
              $this->db_capturista->where('id', $localidad_id);
              $medicos['direcciones'][$i]['localidad'] = $this->db_capturista->get('localidades')->row_array()['localidad'];
              //echo 'LOCALIDAD: '  . $medicos['direcciones'][$i]['localidad'] .'<br/>';
            }

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

        public function create_muestra_llamadas($min,$max){
          $id = array();
          for ($i=0; $i < 1000; $i++) {
            $random = rand($min,$max);
            while(in_array($random,$id)){
              $random = rand($min,$max);
            }
            $id[] = $random;
            if (count($this->db_capturista->get_where('medicos', array('id' => $random,'terminado'=>1))->row_array())>0){
              //Checar si tiene telefono
              if (count($this->db_capturista->get_where('telefonos', array('medico_id' => $random))->row_array())>0)
              {
                if (count($this->db_capturista->get_where('muestraMedicos', array('medico_id' => $random))->row_array())==0){
                  $this->db_capturista->insert('muestraMedicos', array('medico_id'=>$random,'tipoCanal'=>1));
                } else {
                  $i--;
                }
              } else {
                $i--;
              }
            } else {
              $i--;
            }
          }
          return true;
        }

        public function delete_muestraId($id){
          return $this->db_capturista->delete('muestraMedicos', array('id' => $id));
        }

        public function update_muestra($id, $telefono_id, $usuario_capt_id){
          $data = array(
                         'telefono_id' => $telefono_id,
                         'aut' => 1,
                         'usuario_capt_id'=>$usuario_capt_id,
                         'fecha' =>date('Y-m-d H:i:s')
                      );

          $this->db_capturista->where('id', $id);
          return $this->db_capturista->update('muestraMedicos', $data);
        }

        public function update_muestra_NoAut($id, $usuario_capt_id){
          $data = array(
                         'aut' => 2,
                         'usuario_capt_id'=>$usuario_capt_id,
                         'fecha' =>date('Y-m-d H:i:s')
                      );

          $this->db_capturista->where('id', $id);
          return $this->db_capturista->update('muestraMedicos', $data);
        }

        public function update_muestra_Posponer($id,$posponer){
          $data = array(
                         'posponer' => $posponer
                      );

          $this->db_capturista->where('id', $id);
          return $this->db_capturista->update('muestraMedicos', $data);
        }

        public function get_muestraMedicoId($id){
          $this->db_capturista->select('medico_id');
          $this->db_capturista->where('id', $id);
          return $this->db_capturista->get('muestraMedicos')->row_array()['medico_id'];
        }

        public function get_noSeleccionados(){

          $this->db_capturista->select('medicos.*');
          $this->db_capturista->where('terminado',1);
          if (isset($_SESSION['rol']) && $_SESSION['rol'] == "capturista"){
            /*$this->db_capturista->where('DATE(fecha) = DATE(NOW())');
            $this->db_capturista->where('usuario_capt_id',$_SESSION['id']);
            $this->db_capturista->from('medicos');
            */
            $this->db_capturista->where('revisado',0);
            $this->db_capturista->from('medicos');
          } else {
            $this->db_capturista->where('medico_id',null);
            $this->db_capturista->from('medicos');
            $this->db_capturista->join('muestraMedicos', 'muestraMedicos.medico_id = medicos.id', 'left');
          }
          $this->db_capturista->order_by("apellidop", "ASC");
          $result = $this->db_capturista->get();
          $result = $result->result_array();
          $muestra = array();
          foreach ($result as $medico) {
            $medicos = array();
            $medicos['medico'] = $medico;
            $this->db_capturista->where('id',$medico['especialidad_id']);
            $medicos['especialidad'] = $this->db_capturista->get('especialidades')->row_array();
            $this->db_capturista->where('medico_id', $medico['id']);
            $medicos['telefonos'] = $this->db_capturista->get('telefonos')->result_array();
            $this->db_capturista->where('medico_id', $medico['id']);
            $medicos['direcciones'] = $this->db_capturista->get('direcciones')->result_array();
            for ($i=0; $i < count($medicos['direcciones']); $i++) {
              //Estado
              $estado_id = $medicos['direcciones'][$i]['estado'];
              $this->db_capturista->where('id', $estado_id);
              $medicos['direcciones'][$i]['estado'] = $this->db_capturista->get('estados')->row_array()['estado'];
              //Municipio
              $municipio_id = $medicos['direcciones'][$i]['municipio'];
              $this->db_capturista->where('estado_id', $estado_id);
              $this->db_capturista->where('id', $municipio_id);
              $medicos['direcciones'][$i]['municipio'] = $this->db_capturista->get('municipios')->row_array()['municipio'];
              //Localidad
              $localidad_id = $medicos['direcciones'][$i]['localidad'];
              $this->db_capturista->where('id', $localidad_id);
              $medicos['direcciones'][$i]['localidad'] = $this->db_capturista->get('localidades')->row_array()['localidad'];
              //echo 'LOCALIDAD: '  . $medicos['direcciones'][$i]['localidad'] .'<br/>';
            }
            $muestra[] = $medicos;
          }
          return $muestra;
        }


      public function get_noSeleccionadosRevisados(){

        $this->db_capturista->select('medicos.*');
        $this->db_capturista->where('terminado',1);
        $this->db_capturista->where('revisado',1);
        $this->db_capturista->from('medicos');

        $this->db_capturista->order_by("apellidop", "ASC");
        $result = $this->db_capturista->get();
        $result = $result->result_array();
        $muestra = array();
        foreach ($result as $medico) {
          $medicos = array();
          $medicos['medico'] = $medico;
          $this->db_capturista->where('id',$medico['especialidad_id']);
          $medicos['especialidad'] = $this->db_capturista->get('especialidades')->row_array();
          $this->db_capturista->where('medico_id', $medico['id']);
          $medicos['telefonos'] = $this->db_capturista->get('telefonos')->result_array();
          $this->db_capturista->where('medico_id', $medico['id']);
          $medicos['direcciones'] = $this->db_capturista->get('direcciones')->result_array();
          for ($i=0; $i < count($medicos['direcciones']); $i++) {
            //Estado
            $estado_id = $medicos['direcciones'][$i]['estado'];
            $this->db_capturista->where('id', $estado_id);
            $medicos['direcciones'][$i]['estado'] = $this->db_capturista->get('estados')->row_array()['estado'];
            //Municipio
            $municipio_id = $medicos['direcciones'][$i]['municipio'];
            $this->db_capturista->where('estado_id', $estado_id);
            $this->db_capturista->where('id', $municipio_id);
            $medicos['direcciones'][$i]['municipio'] = $this->db_capturista->get('municipios')->row_array()['municipio'];
            //Localidad
            $localidad_id = $medicos['direcciones'][$i]['localidad'];
            $this->db_capturista->where('id', $localidad_id);
            $medicos['direcciones'][$i]['localidad'] = $this->db_capturista->get('localidades')->row_array()['localidad'];
            //echo 'LOCALIDAD: '  . $medicos['direcciones'][$i]['localidad'] .'<br/>';
          }
          $muestra[] = $medicos;
        }
        return $muestra;
      }



      public function get_countMuestra_correos(){
        $this->db_capturista->select('count(*) AS "count"');
        $result = $this->db_capturista->get_where('muestraMedicos',array('tipoCanal'=>4));
        return $result->row_array()['count'];
      }

      public function get_muestra_correosF(){
        $this->load->model('Encuestam_model');
        $muestra = array();
        $result = $this->db_capturista->get_where('muestraMedicos',array('tipoCanal'=>4),500);
        $result = $result->result_array();
        foreach ($result as $muestraMedico) {
          $medico = array();
          $medico['muestra_id'] = $muestraMedico['id'];
          $medico['codigo'] = $this->Encuestam_model->get_encuestamById($muestraMedico['codigo_id'])['codigo'];
          $medico['aut'] = $muestraMedico['aut'];
          $this->db_capturista->where('id', $muestraMedico['medico_id']);
          $medico['medico'] = $this->db_capturista->get('medicos')->row_array();
          $this->db_capturista->where('id',$medico['medico']['especialidad_id']);
          $medico['especialidad'] = $this->db_capturista->get('especialidades')->row_array();
          $this->db_capturista->where('medico_id', $muestraMedico['medico_id']);
          $medico['telefonos'] = $this->db_capturista->get('telefonos')->result_array();
          $this->db_capturista->where('medico_id', $muestraMedico['medico_id']);
          $this->db_capturista->where('nombre', 'consultorio');
          $medico['direcciones'] = $this->db_capturista->get('direcciones')->result_array();

          for ($i=0; $i < count($medico['direcciones']); $i++) {
            //Estado
            $estado_id = $medico['direcciones'][$i]['estado'];
            $this->db_capturista->where('id', $estado_id);
            $medico['direcciones'][$i]['estado'] = $this->db_capturista->get('estados')->row_array()['estado'];
            //Municipio
            $municipio_id = $medico['direcciones'][$i]['municipio'];
            $this->db_capturista->where('estado_id', $estado_id);
            $this->db_capturista->where('id', $municipio_id);
            $medico['direcciones'][$i]['municipio'] = $this->db_capturista->get('municipios')->row_array()['municipio'];
            //Localidad

            $localidad_id = $medico['direcciones'][$i]['localidad'];
            //$medico['direcciones'][$i]['localidad'] = '';
            $this->db_capturista->where('id', $localidad_id);
            $localidad = $this->db_capturista->get('localidades')->row_array();
            $medico['direcciones'][$i]['localidad'] = $localidad['localidad'];
            $medico['direcciones'][$i]['cp'] = $localidad['CP'];

            //tipolocalidad
            $this->db_capturista->where('id', $localidad['tipo_localidad_id']);
            $medico['direcciones'][$i]['tipolocalidad'] = $this->db_capturista->get('tipolocalidad')->row_array()['tipo'];
          }

          $muestra[] = $medico;
        }
        return $muestra;
      }

      public function create_muestra_correos($min,$max){
        $id = array();
        for ($i=0; $i < 500; $i++) {
          $random = rand($min,$max);
          while(in_array($random,$id)){
            $random = rand($min,$max);
          }
          $id[] = $random;
          if (count($this->db_capturista->get_where('medicos', array('id' => $random,'terminado'=>1))->row_array())>0){
            //Checar si tiene direccion y no tiene correo
            $this->db_capturista->where(array(
              'medico_id' => $random,
              'correo'=>'',
              'terminado'=>1,
              'direcciones.nombre'=>'consultorio',
              'localidad<>'=>''
            ));
            $this->db_capturista->select('medicos.nombre, medicos.apellidop, medicos.apellidom');
            $this->db_capturista->from('medicos');
            $this->db_capturista->join('direcciones', 'direcciones.medico_id = medicos.id', 'left');
            $res = $this->db_capturista->get()->row_array();
            if (count($res)>0)
            {
              $nuevo = true;

              $this->db_capturista->reset_query();
              $this->db_capturista->select('nombre');
              $this->db_capturista->select('apellidop');
              $this->db_capturista->select('apellidom');
              $this->db_capturista->where(array('muestraMedicos.id<>'=>null));
              $this->db_capturista->from('medicos');
              $this->db_capturista->join('muestraMedicos', 'muestraMedicos.medico_id = medicos.id', 'left');
              $resMuest = $this->db_capturista->get()->result_array();

              foreach ($resMuest as $resm) {
                if ($resm['nombre'] == $res['nombre'] && $resm['apellidop'] == $res['apellidop'] && $resm['apellidom'] == $res['apellidom']){
                  $nuevo = false;
                  break;
                }
              }

              $this->db_capturista->reset_query();
              if (count($this->db_capturista->get_where('muestraMedicos', array('medico_id' => $random))->row_array())==0 && $nuevo){
                $codigo = $this->generarCodigo(4);
                $codigo_id = $this->Encuestam_model->get_encuestamId($codigo);
                $this->db_capturista->insert('muestraMedicos', array('medico_id'=>$random,'tipoCanal'=>4,'codigo_id'=>$codigo_id));
                //Generar codigo con tipoCodigo = 4
              } else {
                $i--;
              }
            } else {
              $i--;
            }
          } else {
            $i--;
          }
        }
        return true;
      }

      public function generarCodigo($tipo){
        $this->load->model('Encuestam_model');
        $posible = str_split("abcdefghijklmnopqrstuvwxyz0123456789");
        shuffle($posible);
        $codigo = array_slice($posible, 0,6);
        $str = implode('', $codigo);
        while ($this->Encuestam_model->get_encuestamId($str)>0){
          shuffle($posible);
          $codigo = array_slice($posible, 0,6);
          $str = implode('', $codigo);
        }
        $this->Encuestam_model->create_encuestam($str,$tipo);
        return $str;
      }

      public function get_countMuestra_llamadas_sel(){
        $this->db_capturista->select('count(*) AS "count" from muestraMedicos where tipoCanal = 1 AND (aut = 0 OR aut = 1)');
        $result = $this->db_capturista->get();
        return $result->row_array()['count'];
      }

      public function get_countMuestra_llamadas_aut(){
        $this->db_capturista->select('count(*) AS "count" from muestraMedicos where tipoCanal = 1 AND aut = 1');
        $result = $this->db_capturista->get();
        return $result->row_array()['count'];
      }

      public function get_countMuestra_llamadas_rech(){
        $this->db_capturista->select('count(*) AS "count" from muestraMedicos where tipoCanal = 1 AND aut = 2');
        $result = $this->db_capturista->get();
        return $result->row_array()['count'];
      }

      public function get_countMuestra_llamadas_rest(){
        $this->db_capturista->select('count(*) AS "count" from muestraMedicos where tipoCanal = 1 AND aut = 0');
        $result = $this->db_capturista->get();
        return $result->row_array()['count'];
      }

      public function get_reenvios(){
        $result = array();
        $fecha = date('Y-m-j');
        $fecha = strtotime ( '-3 day' , strtotime ( $fecha ) ) ;
        $fecha = date ( 'Y-m-j' , $fecha );

        $this->db_capturista->where(array(
          'medico_id<>'=>null,
          'tipoCanal<>'=>4,
          'correo<>'=>'',
          'aut<>'=>2,
          'fechaEnviado<'=>$fecha
        ));
        $this->db_capturista->from('medicos');
        $this->db_capturista->join('muestraMedicos', 'muestraMedicos.medico_id = medicos.id', 'left');
        $result = $this->db_capturista->get()->result_array();

        $resultado = array();
        foreach ($result as $med) {
          //Revisar si encuesta con id $med['codigo_id'] !codigoUsado or !canalUsado
          $encuesta = $this->db_encuesta->get_where('encuestasM',array('id'=>$med['codigo_id']))->row_array();
          if ($encuesta['canalUsado'] == 0 || $encuesta['codigoUsado'] == 0){
            $resultado[] = array(
              'id'=>$med['id'],
              'nombre'=>capitalize($med['nombre'] . ' ' . $med['apellidop'] . ' ' .$med['apellidom']),
              'correo'=>$med['correo'],
              'codigo'=>$encuesta['codigo'],
              'tipoCodigo'=>$encuesta['tipoCodigo']
          );
          }
        }

        return $resultado;
      }

      function actualizarFechaEnviado($muestra_id){
        $data = array(
                       'fechaEnviado' => date('Y-m-d')
                    );

        $this->db_capturista->where('id', $muestra_id);
        return $this->db_capturista->update('muestraMedicos', $data);
      }

    }

?>
