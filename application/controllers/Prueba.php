<?php
  class Prueba extends CI_Controller
  {
    //constructor
    public function __construct(){
      parent::__construct();
    }
    public function index(){
      $data['titulo'] = "Codigo";
      $data['codigo'] = "193nlP";
      $data['mensaje'] = 'Probando ando';
      $this->load->view('correos/headerCorreo',$data);
      $this->load->view('correos/bodyCorreo',$data);
      $this->load->view('correos/footerCorreo');
    }

    public function correo(){
      $this->load->view('correos/correo');
    }
  }
