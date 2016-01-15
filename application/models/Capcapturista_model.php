<?php
  class Capcapturista_model extends CI_Model
  {
    public function __construct(){
        $this->db_capturista = $this->load->database('capturista', TRUE);
        $this->db_encuesta = $this->load->database('encuesta', TRUE);
    }
    public function insertDatosCapturista($id,$nombre,$apellido,$correo){
      $data = array(
        'id_master' => $id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo
      );
      if( $this->db_capturista->insert('capturista', $data) ){
        return true;
      }else{
        return false;
      }
    }
    public function getDatosNombres($id){
      $this->db_capturista->where('id_master',$id);
      $query = $this->db_capturista->get('capturista');
      return $query;
    }
    public function cargandoInfo(){
      $query = $this->db_capturista->get('capturista');
      return $query;
    }
    public function usuarioInfo($id){
      $this->db_encuesta->where('id',$id);
      $this->db_encuesta->select('usuario');
      $query = $this->db_encuesta->get('master');
      $usuario = "";
      foreach( $query->result() as $row ){
        $usuario = $row->usuario;
      }
      return $usuario;
    }

    public function actualizainfoCapturista($id_usuario, $dataCapturista){
      $this->db_capturista->where('id',$id_usuario);
      $query = $this->db_capturista->update('capturista',$dataCapturista);
    }
    public function actualizainfoMaster($id_master,$data){
      $this->db_encuesta->where('id',$id_master);
      $query2 = $this->db_encuesta->update('master',$data);
    }
    public function getCapturista($id_master){
      $this->db_capturista->where('id_master',$id_master);
      $query = $this->db_capturista->get('capturista');
      return $query;
    }

    public function RegistrosHoy($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "total" FROM medicos where medicos.usuario_capt_id = "'. $id .'" AND DATE(fecha) = DATE(NOW()) AND medicos.terminado = 1;');
      $result = $this->db_capturista->get()->row_array();
      $to_time = strtotime($result['MAX']);
      $from_time = strtotime($result['MIN']);
      $min = intval(round(abs($to_time - $from_time) / 60,2));

      if ($min > 120){
        $min -= 120;
      }
      $result['minutos'] = $min;
      return $result;
    }

    public function RegistrosAyer($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "total" FROM medicos where medicos.usuario_capt_id = "'. $id .'" AND DATE(fecha) = DATE(SUBDATE(NOW(),1)) AND medicos.terminado = 1;');
      $result = $this->db_capturista->get()->row_array();
      $to_time = strtotime($result['MAX']);
      $from_time = strtotime($result['MIN']);
      $min = intval(round(abs($to_time - $from_time) / 60,2));

      if ($min > 120){
        $min -= 120;
      }
      $result['minutos'] = $min;
      return $result;
    }

    public function Registros($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "TOTAL" FROM medicos where medicos.usuario_capt_id = "'. $id .'"  AND medicos.terminado = 1 GROUP BY(DATE(fecha));');
      $result = array();
      $totalRegistros = 0;
      $minutos = 0;
      $Query = $this->db_capturista->get()->result_array();
      $result = array();
      for ($i = 0; $i < count($Query); $i++) {
        $totalRegistros += intval($Query[$i]['TOTAL']);
        $to_time = strtotime($Query[$i]['MAX']);
        $from_time = strtotime($Query[$i]['MIN']);
        $min = intval(round(abs($to_time - $from_time) / 60,2));
        if ($min > 120){
          $min -= 120;
        }
        $Query[$i]['minutos'] = $min;
        $minutos += $min;
      };
      $result['total'] = $totalRegistros;
      $result['minutos'] = $minutos;
      return $result;
    }
    //elimina
    public function deleteMaster($idMaster){
      $this->db_encuesta->where('id',$idMaster);
      $query = $this->db_encuesta->delete('master');
      return $query;
    }
    public function deleteCapturista($idCapturista){
      $this->db_capturista->where('id',$idCapturista);
      $query = $this->db_capturista->delete('capturista');
      return $query;
    }


    public function RegistrosHoyLlamadasAut($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "total" FROM muestramedicos where muestramedicos.usuario_capt_id = "'. $id .'" AND DATE(fecha) = DATE(NOW()) AND muestramedicos.aut = 1;');
      $result = $this->db_capturista->get()->row_array();
      $to_time = strtotime($result['MAX']);
      $from_time = strtotime($result['MIN']);
      $min = intval(round(abs($to_time - $from_time) / 60,2));

      if ($min > 120){
        $min -= 120;
      }
      $result['minutos'] = $min;
      return $result;
    }


    public function RegistrosHoyLlamadasNoAut($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "total" FROM muestramedicos where muestramedicos.usuario_capt_id = "'. $id .'" AND DATE(fecha) = DATE(NOW()) AND muestramedicos.aut = 2;');
      $result = $this->db_capturista->get()->row_array();
      $to_time = strtotime($result['MAX']);
      $from_time = strtotime($result['MIN']);
      $min = intval(round(abs($to_time - $from_time) / 60,2));

      if ($min > 120){
        $min -= 120;
      }
      $result['minutos'] = $min;
      return $result;
    }

    public function RegistrosLlamadasAut($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "TOTAL" FROM muestramedicos where muestramedicos.usuario_capt_id = "'. $id .'"  AND muestramedicos.aut = 1 GROUP BY(DATE(fecha));');
      $result = array();
      $totalRegistros = 0;
      $minutos = 0;
      $Query = $this->db_capturista->get()->result_array();
      $result = array();
      for ($i = 0; $i < count($Query); $i++) {
        $totalRegistros += intval($Query[$i]['TOTAL']);
        $to_time = strtotime($Query[$i]['MAX']);
        $from_time = strtotime($Query[$i]['MIN']);
        $min = intval(round(abs($to_time - $from_time) / 60,2));
        if ($min > 120){
          $min -= 120;
        }
        $Query[$i]['minutos'] = $min;
        $minutos += $min;
      };
      $result['total'] = $totalRegistros;
      $result['minutos'] = $minutos;
      return $result;
    }

    public function RegistrosLlamadasNoAut($id){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "TOTAL" FROM muestramedicos where muestramedicos.usuario_capt_id = "'. $id .'"  AND muestramedicos.aut = 2 GROUP BY(DATE(fecha));');
      $result = array();
      $totalRegistros = 0;
      $minutos = 0;
      $Query = $this->db_capturista->get()->result_array();
      $result = array();
      for ($i = 0; $i < count($Query); $i++) {
        $totalRegistros += intval($Query[$i]['TOTAL']);
        $to_time = strtotime($Query[$i]['MAX']);
        $from_time = strtotime($Query[$i]['MIN']);
        $min = intval(round(abs($to_time - $from_time) / 60,2));
        if ($min > 120){
          $min -= 120;
        }
        $Query[$i]['minutos'] = $min;
        $minutos += $min;
      };
      $result['total'] = $totalRegistros;
      $result['minutos'] = $minutos;
      return $result;
    }

    public function RegistrosLlamadasAnteriores($id){
      $fecha = date('Y-m-d');
      for ($i=0; $i < 5; $i++) {
        # code...
        $nuevafecha = strtotime ( '-'. ($i+1) .' day' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        $result[$i]['dia']= $nuevafecha;
        //Calcular autorizados
        $result[$i]['aut'] = $this->RegistrosHoyLlamadasDate($id,'1',$nuevafecha);
        $result[$i]['noaut'] = $this->RegistrosHoyLlamadasDate($id,'2',$nuevafecha);
      }
      return $result;
    }

    public function RegistrosHoyLlamadasDate($id,$aut,$date){
      $this->db_capturista->select('min(fecha) AS "MIN", max(fecha) AS "MAX", count(*) AS "total" FROM muestramedicos where muestramedicos.usuario_capt_id = "'. $id .'" AND DATE(fecha) = "'.$date.'" AND muestramedicos.aut = '.$aut.';');
      $result = $this->db_capturista->get()->row_array();
      $to_time = strtotime($result['MAX']);
      $from_time = strtotime($result['MIN']);
      $min = intval(round(abs($to_time - $from_time) / 60,2));

      if ($min > 120){
        $min -= 120;
      }
      $total = $result['total'];
      $result= array();
      $result['total'] = $total;
      $result['minutos'] = $min;
      return $result;
    }

    public function LlamadasTotalFechas($id){
      $this->db_capturista->select('fecha FROM muestramedicos where muestramedicos.usuario_capt_id = "'. $id .'"  GROUP BY(DATE(fecha));');
      $result = count($this->db_capturista->get()->result_array());
      return $result;
    }
  }
?>
