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
  }
?>
