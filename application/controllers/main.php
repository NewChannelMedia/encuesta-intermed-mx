<?php
  if (!defined('BASEPATH')) exit('No direct script access allowed');

  class Main extends CI_Controller {
    public function index() {
      $data = array(
        "title" => "Bienvenido a Intermed!",
      );

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
  }
?>
