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
            $data['title'] = "Administradores";
            $this->load->view('templates/header', $data);
            $this->load->view('admin/Admin_vista');
            $this->load->view('templates/footer');
          }
          public function loguin(){
              // se carga el modelo para verificar si existen el usuario y password que se reciben por post
              $this->load->model('admin_model');
              // se atrapan los post del formulario
              $usuario = $this->input->post('user');
              $password = $this->input->post('password');
              if( $this->admin_model->loguin($usuario, $password) != false ){
                $ingresado = true;
                $this->load->library('session');
                $datosAca = array('user'=>$usuario,'ingresado'=>$ingresado);
                $this->session->set_userdata($datosAca);
                $data['title'] = "Control";
                $data['administrador'] = $this->session->user;
                $this->load->view('templates/header', $data);
                $this->load->view('admin/control', $data);
                $this->load->view('templates/footer');
              }else{
                $ingresado = false;
                $data['title'] = "Control";
                $this->load->view('templates/header', $data);
                $this->load->view('admin/error');
                $this->load->view('templates/footer');
              }
          }
          //carga los datos a la tabla por aceptar
          public function porAceptar(){
            $this->load->model('admin_model');
            $query = $this->admin_model->porAceptar();
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
            //return json_encode($aceptar);
          }
      }
  ?>
