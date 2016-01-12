<?php
  if (!defined('BASEPATH')) exit('No direct script access allowed');

  class Main extends CI_Controller {
    public function index() {
      $data = array(
        "title" => "¡Bienvenido a Intermed!",
      );
      session_destroy();

      $this->load->view('templates/header', $data);
      $this->load->view('index', $data);
      $this->load->view('templates/footer', $data);
    }

    public function contacto(){
      $this->load->model('Contacto_model');
      $nombre = $this->input->post('nombre');
      $email = $this->input->post('email');
      $mensaje = $this->input->post('mensaje');
      $obj = array(
        'nombre' => $nombre,
        'correo'=> $email,
        'mensaje'=> $mensaje
      );
      $result = $this->Contacto_model->insertData($obj);
      $array = array();
      $array['result'] = $result;
      echo json_encode($array);
    }

    public function override404(){
        $data = array(
          "title" => "Intermed - Página no encontrada"
        );
        $this->load->view('templates/header', $data);
        $this->load->view('404');
        $this->load->view('templates/footerAdmin');
    }

    public function terminos(){
        $data = array(
          "title" => "Intermed - Política de privacidad"
        );
        $this->load->view('templates/header', $data);
        $this->load->view('terminos', $data);
        $this->load->view('templates/footer', $data);
    }

    function usarCodigo($codigo){
      //marcar canal de codigo como usado
      if ($codigo != ""){
        $this->load->model('Encuestam_model');
        $this->Encuestam_model->marcarEncuestaCanalUsado($codigo);
      }
      $this->index();
    }
  }
?>
