<?php
  class Emails_model extends CI_Model{
    //constructor
    public function __construct(){
      // las siguientes dos lineas serviran para cargar las dos bases de datos
      $this->db_encuesta = $this->load->database( 'encuesta', TRUE );
      $this->db_capturista = $this->load->database( 'capturista', TRUE );
      // carga otros modelos
      $this->load->model('Encuestam_model');
    }
    private function makeCode(){
      $posible = str_split("abcdefghijklmnopqrstuvwxyz0123456789");
      shuffle($posible);
      $codigo = array_slice($posible, 0,6);
      $str = implode('', $codigo);
      while ($this->Encuestam_model->get_encuestamId($str)>0){
         shuffle($posible);
         $codigo = array_slice($posible, 0,6);
         $str = implode('', $codigo);
       }
      return $str;
    }
    //function que trae todos los emails requeridos
    public function traeMails(){
      $arreglo = array();
      $this->db_capturista->where('tipoCanal',3);
      $this->db_capturista->from('muestraMedicos');
      $contador = $this->db_capturista->count_all_results();
      if( $contador == 0 ){
        for( $i = 0; $i < 500; $i++ ){
          $random = rand(1,3009);
          while ( in_array($random, $arreglo) ) {
            $random = rand(1,3009);
          }
          if( count($this->db_capturista->get_where('medicos', array('id' => $random,'terminado'=>1))->row_array())>0 ){
            if( count($this->db_capturista->get_where('medicos', array('correo !=' => '') )->row_array())>0 ){
              if( count($this->db_capturista->get_where('muestraMedicos', array('medico_id' => $random))->row_array())==0 ){
                 $this->db_capturista->where('id',$random);
                 $query = $this->db_capturista->get('medicos');
                 foreach( $query->result() as $row ){
                   if( $row->correo != '' && !is_numeric($row->correo) ){
                     $arreglo[ $i ]['correo'] = $row->correo;
                     $this->db_capturista->insert('muestraMedicos', array('medico_id'=>$random,'tipoCanal'=>3,'codigo_id'=>0));
                   }
                 }
              }else{
                $i--;
              }
            }else{
              $i--;
            }
          }else{
            $i--;
          }
        }
        return $arreglo;
      }else{
        return false;
      }
    }
    //trae los correos de muestraMedicos
    public function getMails(){
      // hara un join para traer los correos y solo mostrar eso
      $arreglo = array();
      $this->db_capturista->where('aut',0);
      $this->db_capturista->select('correo');
      $this->db_capturista->select('nombre');
      $this->db_capturista->select('apellidop');
      $this->db_capturista->from('medicos');
      $this->db_capturista->join('muestraMedicos','muestraMedicos.medico_id = medicos.id');
      $query = $this->db_capturista->get();
      $i = 0;
      foreach( $query->result() as $row ){
        if( $row->correo != '' && !is_numeric($row->correo) ){
          $arreglo[ $i ][ 'correos' ] = $row->correo;
          $arreglo[ $i ][ 'nombres' ] = $row->nombre.' '.$row->apellidop;
          $i++;
        }
      }
      return $arreglo;
    }
    // retorna la consulta con los correos contestados
    public function getMailsSends(){
      // hara un join para traer los correos y solo mostrar eso
      $arreglo = array();
      $this->db_capturista->where(array('aut'=>1,'tipoCanal'=>3));
      $this->db_capturista->select('correo');
      $this->db_capturista->select('nombre');
      $this->db_capturista->select('apellidop');
      $this->db_capturista->from('medicos');
      $this->db_capturista->join('muestraMedicos','muestraMedicos.medico_id = medicos.id');
      $query = $this->db_capturista->get();
      $i = 0;
      foreach( $query->result() as $row ){
        if( $row->correo != '' && !is_numeric($row->correo) ){
          $arreglo[ $i ][ 'correos' ] = $row->correo;
          $arreglo[ $i ][ 'nombres' ] = $row->nombre.' '.$row->apellidop;
          $i++;
        }
      }
      return $arreglo;
    }
    /**
    * con la siguiente funcion es la que se encargara de hacer el envio de los
    * correos esta sera llamada desde la funcion masiveMails y dejara de ejecutarse hasta que
    * recorra todos los valores del array, tendra dos parametros.
    *
    * @param correo, el correo de la persona la cual se va a enviar
    * @param nombre, el nombre para personalizar el correo
    *
    **/
    public function passofHel($correo, $nombre, $cuerpo ){
      $ultimoID = "";
      $medico_id = 0;
      $codigo = "";
      $codigoPop = $this->makeCode();
      $objEncuestaM = array(
        'codigo' => $codigoPop,
        'tipoCodigo' => 3
      );
      // se hace el registro a encuestaM
      $this->db_encuesta->insert('encuestasM',$objEncuestaM);
      // se hace una consulta para traer el ultimo codigo registrado y se trae el id
      $this->db_encuesta->where('codigo',$codigoPop);
      $this->db_encuesta->select('id');
      $this->db_encuesta->select('codigo');
      $queryID = $this->db_encuesta->get('encuestasM');
      foreach( $queryID->result() as $row ){
        $ultimoID = $row->id;
        $codigo = $row->codigo;
      }
      // se obtiene el id del medico
      $this->db_capturista->where('correo',$correo);
      $this->db_capturista->select('id');
      $query2ID = $this->db_capturista->get('medicos');
      foreach( $query2ID->result() as $row ){
        $medico_id = $row->id;
      }
      // objecto para insertar en muestra medico
      $objMuestra = array(
        'aut' => 1,
        'codigo_id' => $ultimoID
      );
      // se hace la condicion para la actualizacion de la tabla muestraMedicos
      $this->db_capturista->where('medico_id',$medico_id);
      // se actualiza los datos en la tabla muestraMedicos
      $this->db_capturista->update('muestraMedicos',$objMuestra);
      // aqui se hace el envio de el correo a las direcciones seleccionadas
      // se lee el archivo
      $file = realpath(APPPATH.'views/correos/headerMasivo.php');//header
      $file2 = realpath(APPPATH.'views/correos/correoMasivo.php');//body
      $file3 = realpath(APPPATH.'views/correos/footerMasivo.php');//footer
      // se lee el archivo
      $fread = fopen($file,'r');
      $fread2 = fopen($file2,'r');
      $fread3 = fopen($file3,'r');
      $html = "";
      $html2 = "";
      $html3 = "";
      // se recorreo todo el archivo y se va concatenando su informacion en la variable html
      while( $line = fgets($fread) ){
        $html .= $line;
      }
      while( $line = fgets($fread2) ){
        $html2 .= $line;
      }
      while( $line = fgets($fread3) ){
        $html3 .= $line;
      }
      // se cierra el flujo del archivo
      fclose($fread);
      fclose($fread2);
      fclose($fread3);
      // se llena la plantilla con la informacion que debe de sustituirse
      $sustituirNombre = '<span id="nombreDoc">'.$nombre.'</span>';
      $codigoSus = '<span id="codigoSend" style="font-size:25px;letter-spacing:2px;text-transform:uppercase;">'.$codigo.'</span>';
      $mensajeSus = '<p id="mensajeMasivo">'.$cuerpo.'</p>';
      $cambio = str_replace('<span id="nombreDoc"></span>',$sustituirNombre, $html2);
      $ch = '<span id="codigoSend" style="font-size:25px;letter-spacing:2px;text-transform:uppercase;"></span>';
      $cambio2 = str_replace($ch,$codigoSus,$cambio);
      $cambio3 = str_replace('<p id="mensajeMasivo"></p>',$mensajeSus,$cambio2);
      $mensajeCompleto = $html.$cambio3.$html3;

      //header y envios
      $titulo = "Te presentamos Intermed®";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-Type:text/html;charset=utf-8" . "\r\n";
      $headers .= 'Bcc: pruebamasivos@newchannel.mx' . "\r\n";
      $headers .= 'From: Intermed <intermed.encuestas@newchannel.mx>'."\r\n";
      return mail($correo,$titulo,$mensajeCompleto,$headers);
    }
  }
?>
