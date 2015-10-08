<?php
      /**
      * Controlador para trabajar con la informacion que puede ver los administradores,
      * del sitio, la tabla para aceptar las solicitudes que nos lleguen.
      * Se usaran sessiones para los usuarios
      *
      */
      class Admin extends CI_Controller
      {
          // carga del constructor
          public function index(){
            //$this->load->library('session');
            $data['title'] = "Administradores";
            $data['login_status'] = true;
            $this->load->view('templates/headerAdmin', $data);
            $this->load->view('admin/Admin_vista');
            $this->load->view('templates/footer2');
          }
          public function login(){
              // se carga el modelo para verificar si existen el usuario y password que se reciben por post
              $this->load->model('Admin_model');
              // se atrapan los post del formulario
              $usuario = $this->input->post('user');
              $password = $this->input->post('password');
              if( $this->Admin_model->login($usuario, $password) != false ){
                $data['title'] = "Control";
                $data['administrador'] = $usuario;
                $data['user'] = $usuario;
                $_SESSION['status'] = true;
                $this->load->view('templates/headerAdmin', $data);
                $this->load->view('admin/control', $data);
                $this->load->view('templates/footer2');
              }else{
                $data['title'] = "Control";
                $_SESSION['status'] = false;
                $data['status'] = $_SESSION['status'];
                $this->load->view('templates/headerAdmin', $data);
                $this->load->view('admin/error', $data);
                $this->load->view('templates/footer2');
              }
          }
          //cerrar sesion
          public function cerrar(){
            $_SESSION['status'] = false;
            return session_destroy();
          }
          //carga los datos a la tabla por aceptar
          public function porAceptar(){
            $this->load->model('Admin_model');
            $query = $this->Admin_model->porAceptar();
            $aceptar = array();
            $i = 0;
            foreach( $query->result() as $row ){
              $aceptar[$i]['id'] = $row->id;
              $aceptar[$i]['nombre'] = $row->nombre;
              $aceptar[$i]['correo'] = $row->correo;
              $aceptar[$i]['medico'] = $row->medico;
              $aceptar[$i]['cedula'] = $row->cedula;
              $aceptar[$i]['justificacion'] = $row->justificacion;
              $aceptar[$i]['status'] = $row->status;
              $i++;
            }
            print_r(json_encode($aceptar));
          }
          //inserta el codigo
          public function insertaCodigo($codigo){
            $this->load->model('Admin_model');
            return $this->Admin_model->insertaCodigoGenerado($codigo);
          }
      }
