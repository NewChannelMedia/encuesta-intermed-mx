<?php
  class Pages extends CI_Controller {

      public function __construct(){
        parent::__construct();
      }

    public function index($page = 'index'){
      if(!file_exists('application/views/'.$page.'.php')){
        show_404();
      }
      $data['title']=ucfirst($page);

      $this->load->view('templates/header', $data);
      $this->load->view($page, $data);
      $this->load->view('templates/footer', $data);

    }

    public function view ($page = 'home'){
      if(!file_exists('application/views/pages/'.$page.'.php')){
        show_404();
      }
      $data['title']=ucfirst($page);

      $this->load->view('templates/header', $data);
      $this->load->view('pages/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }

    public function about (){
      if(!file_exists('application/views/about.php')){
        show_404();
      }
      $data['title']=ucfirst('about');

      $this->load->view('templates/header', $data);
      $this->load->view('about', $data);
      $this->load->view('templates/footer', $data);
    }

  }
?>
