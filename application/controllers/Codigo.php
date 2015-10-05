<?php
  /**
  * En esta clase se manera todo lo relacionado con lo de los codigos
  * desde Generarlo hasta comprobar que exista. En caso que no exista,
  * se mandara a llamar otras funciones de otras clases para su uso, y
  * realice la tarea destinada que tiene el metodo que las esta llamando
  *
  *
  **/
  class Codigo extends CI_Controller
  {
      //metodo que carga la pagina
      public function index(){
        $this->load->helpers('url');
        $data['url'] = base_url('/codigo/pedir');
        $this->load->view('templates/header');
        $this->load->view('codigo/genera');
        $this->load->view('templates/footer');
      }
      // metodo para generar el codigo
      public function makeCode(){
        $posible = str_split("abcdefghijklmnopqrstuvwxyz0123456789");
        shuffle($posible);
        $codigo = array_slice($posible, 0,6);
        $str = implode('', $codigo);
        print_r(json_encode($str));
        /*$data['numero'] = $str;
        $this->load->view('codigo/genera', $data);*/
      }
      /**
      * funcion para enviar el correo
      *
      *
      * @param: $to el correo de la persona
      * @param: $subject: el Asunto del correo
      * @param: file la plantilla que se enviara al usuario
      **/
      public function sendMail($to,$subject,$file){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <intermed.encuestas@newchannel.mx>'."\r\n";
        // se lee el archivo para guardarlo en una variable y poderlo enviar
        $archivo = "";
        $archivo .= "/application/views/correos/".$file;
        $fichero_texto = "".file_get_contents($archivo);
        print_r($fichero_texto);
        //return mail($to,$subject,$fichero_texto,$headers);
      }
      /**
      * Se valida la cedula, en ser real se le envia un correo con el codigo, nuevo, y ese codigo quedara registrado
      * en caso de ser falso se le envia un correo diciendole que la cedula es falsa
      *
      * @param $cedula: el numero de cedula
      * @param $email: correo, para el envio de los datos
      */
      public function validateCedula( $correo, $email ){
        // se hace una validacion si cedula es verdadera
        // quiere decir que si es una cedula real
        if( $cedula == true ){
          //se insera ala db el codigo nuevo, se envia hacia que responda la encuesta
        }else{
          // se envia un correo diciendole que su cedula es falsa,
        }
      }
      public function pedir(){
        $data['title'] = "Cedula";
        $this->load->view('templates/header',$data);
        $this->load->view('codigo/pedir');
        $this->load->view('templates/footer2');
      }
      public function dataPostCorreo(){
        $this->load->model('porValidar_model');
        $correo = $this->input->post('email');
        $data['correito'] = $correo;
        if( $this->porValidar_model->insertData($correo)){
          $this->load->view('templates/header');
          $this->load->view('codigo/medico',$data);
          $this->load->view('templates/footer2');
        }
        else{
          return false;
        }
      }

      public function dataPost(){
        $this->load->model('porValidar_model');
        $nombre = $this->input->post('nombre');
        $correo = $this->input->post('email');
        $medico = $this->input->post('medico');
        $cedula = $this->input->post('cedula');
        $justificacion = $this->input->post('justificacion');

        $data['title'] = "intermed";
        $data['nombre'] = $nombre;
        $data['correo'] = $correo;
        $data['medico'] = $medico;
        $data['cedula'] = $cedula;
        $data['justificacion'] = $justificacion;

        if( $this->porValidar_model->insertData($nombre, $correo, $medico, $cedula, $justificacion)){
          $this->load->view('templates/header', $data);
          $this->load->view('codigo/mensaje',$data);
          $this->load->view('templates/footer2');
        }
        else{
          return false;
        }
      }

  }
?>
