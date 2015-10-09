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
            $data['login_status'] = true;
            $data['errorM'] = "";
            $this->load->view('templates/header', $data);
            $this->load->view('admin/Admin_vista');
            $this->load->view('templates/footer2');
          }

          public function control(){
              // se carga el modelo para verificar si existen el usuario y password que se reciben por post
              $this->load->model('Admin_model');
              // se atrapan los post del formulario
              $usuario = $this->input->post('user');
              $password = $this->input->post('password');

              if( ($this->Admin_model->login($usuario, $password) != false) || ($_SESSION['status']!=false) ){
                $data['title'] = "Dashboard";
                $data['administrador'] = $usuario;
                $data['user'] = $usuario;
                $_SESSION['status'] = true;
                $data['session'] = $_SESSION['status'];
                $data['errorM'] = "";
                $this->load->view('templates/headerAdmin', $data);
                $this->load->view('admin/control', $data);
                $this->load->view('templates/footerAdmin');
              }else{
                $data['title'] = "Dashboard";
                $_SESSION['status'] = false;
                $data['status'] = $_SESSION['status'];
                $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
                $this->load->view('templates/header', $data);
                $this->load->view('admin/Admin_vista', $data);
                $this->load->view('templates/footerAdmin');
              }
          }

          public function solicitudes(){
              // se carga el modelo para verificar si existen el usuario y password que se reciben por post
              $this->load->model('Admin_model');
              $session = $_SESSION['status'];
              if($session!=false){
                $data['title'] = "Solicitud true";
                $_SESSION['status'] = true;
                $data['errorM'] = "";
                $this->load->view('templates/headerAdmin', $data);
                $this->load->view('admin/solicitudes', $data);
                $this->load->view('templates/footerAdmin');
              }else{
                $data['title'] = "Solicitud false";
                $data['error'] = "no sesion";
                $_SESSION['status'] = false;
                $data['status'] = $_SESSION['status'];
                $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
                $this->load->view('templates/header', $data);
                $this->load->view('admin/Admin_vista', $data);
                $this->load->view('templates/footerAdmin');
              }
          }

          //cerrar sesion
          public function cerrar(){
            $_SESSION['status'] = false;
            $data['errorM'] = "";
            $this->load->view('templates/header');
            $this->load->view('admin/Admin_vista', $data);
            $this->load->view('templates/footer2');
            //return session_destroy();
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

          public function suscritos(){
            $this->load->model('Admin_model');
            $query = $this->Admin_model->suscripcionNewsletter();
            $newsletter = array();
            $i = 0;
            foreach( $query->result() as $row ){
              $newsletter[$i]['id'] = $row->id;
              $newsletter[$i]['nombre'] = $row->nombre;
              $newsletter[$i]['correo'] = $row->correo;
              $i++;
            }
            $data["newsletter"] = $newsletter;

            $this->load->view('templates/headerAdmin', $data);
            $this->load->view('admin/suscritos', $data);
            $this->load->view('templates/footerAdmin');

            return json_encode($newsletter);
          }

          //inserta el codigo
          public function insertaCodigo($codigo){
            $this->load->model('Admin_model');
            return $this->Admin_model->insertaCodigoGenerado($codigo);
          }
      }
  ?>
