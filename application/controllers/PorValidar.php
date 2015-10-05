  <?php
      class PorValidar extends CI_Controller
      {
          public function index(){
            $this->load->view('templates/header');
            $this->load->view('codigo/medico');
            $this->load->view('templates/footer');
          }
          public function insertNC(){
            $this->load->model('porValidar_model');
            $nombre = $this->input->post('nombre');
            $cedula = $this->input->post('cedula');
            $oculto = $this->input->post('correoOculto');
            if($this->porValidar_model->updateData($oculto,$nombre,$cedula) == true){
              $data['title'] = "Revisar cedula";
              $data['nombre'] = $nombre;
              $data['correo'] = $oculto;
              $data['cedula'] = $cedula;
              $this->load->view('templates/header',$data);
              $this->load->view('codigo/mensaje', $data);
              $this->load->view('templates/footer2');
            }else{

            }
          }
          public function usuario(){
            //cargar modelo para actualizar
            $this->load->model('porValidar_model');
            $nombre = $this->input->post('usuario_nombre');
            $justificacion = $this->input->post('justificacion');
            $oculto = $this->input->post('usuarioOculto');
            if( $this->porValidar_model->usuarioInsert($oculto, $nombre, $justificacion)){
              $data['title'] = "Revisar cedula";
              $data['nombre'] = $nombre;
              $data['cedula'] = "";
              $data['correo'] = $oculto;
              $this->load->view('templates/header',$data);
              $this->load->view('codigo/mensaje', $data);
              $this->load->view('templates/footer2');
            }
          }
      }
  ?>
