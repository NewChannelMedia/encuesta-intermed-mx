<?php
  /**
  * En esta clase se manera todo lo relacionado con lo de los codigos
  * desde Generarlo hasta comprobar que exista. En caso que no exista,
  * se mandara a llamar otras funciones de otras clases para su uso, y
  * realice la tarea destinada que tiene el metodo que las esta llamando
  *
  *
  **/
  class Capturista extends CI_Controller
  {
      public function __construct(){
        parent::__construct();
        $this->load->helpers('url');
        $this->load->model('Capespecialidades_model');
        $this->load->model('Capmedicos_model');
        $this->load->model('Capdirecciones_model');
        $this->load->model('Captelefonos_model');
        $this->load->model('Capmuestramed_model');
      }
      /*
      public function index(){
        $especialides = $this->Capespecialidades_model->get_especialidades();
        foreach ($especialides as $value) {
          # code...
          echo $value['id'] . ' - ' . $value['especialidad'] . '<br/>';
        }
      }
      */
      public function guardarMedico(){
        //$usuario = $this->input->post('user');
        $data = array(
          'nombre'=>$this->input->post('nombre'),
          'apellidop'=>$this->input->post('apellidoP'),
          'apellidom'=>$this->input->post('apellidoM'),
          'correo'=>$this->input->post('email')
        );
        //'especialidad_id'=>$this->input->post('especialidad'),

        $especialidad = $this->input->post('especialidad');

        if ($especialidad != ''){
          //Buscar la especialidad, traer id
          $id = $this->Capespecialidades_model->get_especialidadId($especialidad);
          //Si no id, insertarlo y traer el id
          if ($id <= 0){
            $id = $this->Capespecialidades_model->create_especialidad($especialidad);
          }
          $data['especialidad_id'] = $id;
        }

        $id = $this->Capmedicos_model->create_medico($data);
        echo json_encode(array('success'=>true,'medico_id'=>$id));
      }

      public function guardarTelefono(){
        //$usuario = $this->input->post('user');
        $data = array(
          'medico_id'=>$this->input->post('medico_id'),
          'claveRegion'=>$this->input->post('claveRegion'),
          'numero'=>$this->input->post('numero'),
          'tipo'=>$this->input->post('tipo')
        );

        $result = $this->Captelefonos_model->create_telefono($data);
        echo json_encode(array('success'=>$result));
      }


      /**
      * Recibe los valores por post para su envio al modelo y los inserte en su
      * correspondiente tabla en la base de datos
      * @param NO PARAMS
      **/
      public function insertDireccion(){
        $consultorio = $this->input->post('consultorio');
        $calle = $this->input->post('calle');
        $estado = $this->input->post('estado');
        $municipio = $this->input->post('municipio');
        $ciudad = $this->input->post('ciudad');
        $localidad = $this->input->post('localidad');
        $id_medico = $this->input->post('id_medico');
        $cp = $this->input->post('cp');
        $numero = $this->input->post('numero');
        $data = array(
          'nombre'=>$consultorio,
          'estado'=>$estado,
          'municipio'=>$municipio,
          'ciudad'=>$ciudad,
          'localidad'=>$localidad,
          'cp'=>$cp,
          'calle'=>$calle,
          'numero'=>$numero,
          'medico_id'=>$id_medico
        );
        return $this->Capdirecciones_model->insertDireccion($data);
      }

      public function generarMuestraMedicos(){
        $data = array('success'=>true);
        $total = $this->Capmuestramed_model->get_countMuestra();
        $data['count'] = $total;

        if ($total == 0){
          //Generar muestra
          $min = intval($this->Capmuestramed_model->get_minIdMedicos());
          $max = intval($this->Capmuestramed_model->get_maxIdMedicos());
          $data['min']= $min;
          $data['max']= $max;

          if ($min == $max){
            //No hay medicos registrados
            $result = false;
            $data['error'] = 'No hay médicos registrados';
          } else if (($max-$min) < 999){
            //Medicos registrados insuficientes (mínimo 1000)
            $result = false;
            $data['error'] = 'Médicos registrados insuficientes (mínimo 1000)';
          } else {
            $result = $this->Capmuestramed_model->create_muestra($min,$max);
            if ($result){
              $data['muestra'] =  $this->Capmuestramed_model->get_muestra();
            } else {
              $data['error'] = 'Error al crear la muestra';
            }
          }
        } else $data['muestra'] =  $this->Capmuestramed_model->get_muestra();
        echo json_encode($data);
      }

      public function guardarMuestraMedico(){
        $id = $this->input->post('id');
        $telefono_id = $this->input->post('telefono_id');
        $correo = $this->input->post('correo');
        $correo2 = $this->input->post('correo2');
        $aut = $this->input->post('aut');

        if ($correo != ""){
          //Actualizar correo del medico
          $medico_id = $this->Capmuestramed_model->get_muestraMedicoId($id);
          $this->Capmedicos_model->update_medico($medico_id,$correo);
        }

        $result = false;
        if ($aut == "true"){
          $result = $this->Capmuestramed_model->update_muestra($id, $telefono_id);

          if ($result){
            if ($correo == ""){
              $this->enviarCodigo($correo2);
            } else $this->enviarCodigo($correo);
          }
        } else {
          //Eliminar de muestra el id
          $result = $this->Capmuestramed_model->delete_muestraId($id);
        }

        $array = array('success'=>$result);

        echo json_encode($array);
      }

      public function enviarCodigo($email){
        $correo = $email;
        $titulo = 'Mensaje de Intermed';
        $codigo = $this->generarCodigo();
        // se lee el archivo
        $fileh = realpath(APPPATH.'views/correos/headerCorreo.php');
        $fileb = realpath(APPPATH.'views/correos/bodyCorreo.php');
        $filef = realpath(APPPATH.'views/correos/footerCorreo.php');
        $fpH = fopen( $fileh,'r');
        $fpB = fopen( $fileb,'r');
        $fpF = fopen( $filef,'r');

        $html1 = "";
        $html2 = "";
        $html3 = "";
        while( $line = fgets($fpH) ){
          $html1 .= $line;
        }
        while( $line = fgets($fpB) ){
          $html2 .= $line;
        }
        while( $line = fgets($fpF) ){
          $html3 .= $line;
        }
        fclose($fpH);
        fclose($fpB);
        fclose($fpF);
        $mensajeCompleto = "";
        $sustituir = '<span id="codigo">'.$codigo.'</span>';
        $conCodigo = str_replace('<span id = "codigo"></span>',$sustituir, $html2);
        $mensajeCompleto = $html1.$conCodigo.$html3;
        echo 'mensaje completo: '.$mensajeCompleto;

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <intermed.encuestas@newchannel.mx>'."\r\n";
        return mail($correo,$titulo,$mensajeCompleto,$headers);
      }

      public function generarCodigo(){
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
        $this->Encuestam_model->create_encuestam($str);
        return $str;
      }

      public function obtenerNoSeleccionados(){
        //Select * from t1 where not exists (select 1 from t2 where t2.id = t1.id)
        $noSeleccionados = $this->Capmuestramed_model->get_noSeleccionados();
        $array = array('success'=>true,'muestra'=>$noSeleccionados);
        echo json_encode($array);
      }

      public function obtenerDatosMedicoId(){
        $id = $this->input->post('id');
        $medico = $this->Capmedicos_model->get_medico($id);
        echo json_encode($medico);
      }

      public function eliminarDireccion(){
        $id = $this->input->post('id');
        echo json_encode(array('success'=>TRUE));
      }

      public function eliminarTelefono(){
        $id = $this->input->post('id');
        echo json_encode(array('success'=>TRUE));
      }
  }
?>
