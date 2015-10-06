<?php
  class Resultados extends CI_Controller {


    public function __construct(){
      parent::__construct();
      $this->load->model('Encuestam_model');
      $this->load->model('Categorias_model');
      $this->load->model('Preguntasm_model');
      $this->load->model('Respuestasm_model');
      header('Cache-Control: no cache');
    }

    public function index(){
      if(!file_exists('application/views/resultados/index.php')){
        show_404();
      }

      $resultado = array();

      $categorias = $this->Categorias_model->get_categorias();

      $total = 0;
      foreach ($categorias as $cat) {
          $categoriasArray = array();
          $categoriasArray['name'] = $cat['categoria'];
          $preguntas = $this->Preguntasm_model->get_preguntamByCategoria($cat['id']);
          $preguntasArray = array();
          foreach ($preguntas as $preg) {
              $pregArray = array();
              $pregArray['pregunta'] = $preg['pregunta'];
              $pregArray['respuestas'] = array();
              $respuestas = $this->Respuestasm_model->get_respuestamByPregunta($preg['id']);
              $opciones = array();
              $resultadoTextEnum = array();
              $resultadoRadioComplemento = array();
              if ($preg['tipo'] == 'text|enum' || $preg['tipo'] == 'radio'){
                $opciones = explode('|', $preg['opciones'] );
              }

              foreach ($respuestas as $resp) {
                $respFinal = array();
                if ($preg['tipo'] == "radio"){
                  $resp['respuesta'] = explode(':|comp:', $resp['respuesta']);

                  if (count($resp['respuesta']) == 1){
                    $resultadoRadioComplemento[$resp['respuesta'][0]] = $resp['total'];
                  } else {
                    $resp['respuesta'][1] = strtolower($resp['respuesta'][1]);
                    if (array_key_exists($resp['respuesta'][0],$resultadoRadioComplemento)){
                      $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] =  $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] + $resp['total'];
                      if (array_key_exists($resp['respuesta'][1], $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'])){
                        $cant =   $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]];
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $cant + $resp['total'];
                      } else {
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $resp['total'];
                      }
                    } else {
                      $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] = $resp['total'];
                      $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $resp['total'];
                    }
                  }
                  $respFinal['respuesta'] = $resultadoRadioComplemento;
                  $pregArray['respuestas'][0] = $respFinal;

                } elseif ($preg['tipo'] == "text|enum"){
                  //SPLIT con |
                  $resp['respuesta'] = explode('|', $resp['respuesta'] );
                  for ($i = 0; $i < count($resp['respuesta']); $i++) {
                    if (array_key_exists($opciones[$i],$resultadoTextEnum)){
                      $resultadoTextEnum[$opciones[$i]] = $resultadoTextEnum[$opciones[$i]] + (count($opciones) + 1 - $resp['respuesta'][$i]);
                    } else {
                      $resultadoTextEnum[$opciones[$i]] = (count($opciones) + 1 - $resp['respuesta'][$i]);
                    }
                  }
                  arsort($resultadoTextEnum);
                  $respFinal['respuesta'] = $resultadoTextEnum;
                  $respFinal['total'] = '';
                  $pregArray['respuestas'][0] = $respFinal;
                } else {
                  $respFinal['respuesta'] = $resp['respuesta'];
                  $respFinal['total'] = $resp['total'];
                  $pregArray['respuestas'][] = $respFinal;
                }
              }
              $preguntasArray[] = $pregArray;
          }
          $categoriasArray['preguntas'] = $preguntasArray;
          $resultado[] = $categoriasArray;
      }

      $data = array('resultado'=> $resultado);

      $this->load->view('templates/header', $data);
      $this->load->view('resultados/index', $data);
      $this->load->view('templates/footer', $data);

    }
  }
?>
