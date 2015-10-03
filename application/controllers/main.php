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
  }
?>
