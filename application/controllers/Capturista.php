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
      }

      public function index(){
        $especialides = $this->Capespecialidades_model->get_especialidades();
        foreach ($especialides as $value) {
          # code...
          echo $value['id'] . ' - ' . $value['especialidad'] . '<br/>';
        }
      }

      /**
      * Recibe los valores por post para su envio al modelo y los inserte en su
      * correspondiente tabla en la base de datos
      * @param NO PARAMS
      **/
      public function insertDireccion(){
        $valor = $this->input->post('prueba');
        var_dump("Hola mundo ".$valor);
      }
  }
?>
