<?php
  class Encuesta extends CI_Controller {

    public function index($page = 'index'){
      if(!file_exists('application/views/encuesta/'.$page.'.php')){
        show_404();
      }
      $data['title']=ucfirst($page);

      $this->load->view('templates/header', $data);
      $this->load->view('encuesta/'.$page, $data);
      $this->load->view('templates/footer', $data);

    }

    public function view($page = 'encuesta'){
      if(!file_exists('application/views/encuesta/'.$page.'.php')){
        show_404();
      }
      $data['title']=ucfirst($page);

      $this->load->view('templates/header', $data);
      $this->load->view('encuesta/'.$page, $data);
      $this->load->view('templates/footer', $data);

    }

  }
?>
