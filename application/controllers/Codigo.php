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
      }
      /**
      * funcion para enviar el correo
      *
      *
      * @param: $to el correo de la persona
      * @param: $subject: el Asunto del correo
      * @param: file la plantilla que se enviara al usuario
      **/
      public function sendMail(){
          $correo = $this->input->post('correo');
          $titulo = $this->input->post('titulo');
          $codigo = $this->input->post('codigo');
          $mensaje = $this->input->post('mensaje');
          // se lee el archivo
          $fileh = realpath(APPPATH.'views/correos/headerCorreo.php');
          $fileb = realpath(APPPATH.'views/correos/bodyCorreo.php');
          $filef = realpath(APPPATH.'views/correos/footerCorreo.php');
          $fpH = fopen( $fileh,'r');
          $fpB = fopen( $fileb,'r');
          $fpF = fopen( $filef,'r');
          $html1 = "";
          $html2 = "";
          $html3 = "";
          while( $line = fgets($fpH) ){
            $html1 .= $line;
          }
          while( $line = fgets($fpB) ){
            $html2 .= $line;
          }
          while( $line = fgets($fpF) ){
            $html3 .= $line;
          }
          fclose($fpH);
          fclose($fpB);
          fclose($fpF);
          $mensajeCompleto = "";
          if($estado == 1){
          	$sustituir = '<h2 style = "{color:red;}">'.$codigo.'</h2>';
            	$conCodigo = str_replace('<h2 id = "codigo"></h2>',$sustituir, $html2);
            	if($mensaje != ""){
	              $sustituir2 = "<p style = 'color:red;'>".$mensaje."</p>";
	              $conCodigo2 = str_replace('<p id ="mes"></p>',$sustituir2, $conCodigo);
	              $mensajeCompleto = $html1.$conCodigo2.$html3;
	        }else{
	        	$mensajeCompleto = $html1.$conCodigo.$html3;
	        }
          }else{
          	$borrar = array(
          		'<span>Este es tu c贸digo de acceso al sistema: <h2 id = "codigo"></h2></span>',
          		'<span><p>con el Cual puedes entrar en la siguiente liga</p></span>',
          		'<a href = "http://www.newchannel.mx/encuesta-intermed">Usar mi c贸digo</a>'
          	);
              $sustituir3 = "<p style = '{color:red;}'>".$mensaje."</p>";
              $conCodigo5 = str_replace('<p id ="mes"></p>',$sustituir3,$html2);
              $conCodigo4 = str_replace($borrar,'',$conCodigo5);
              $mensajeCompleto = $html1.$conCodigo4.$html3;
          }
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: <intermed.encuestas@newchannel.mx>'."\r\n";
          return mail($correo,$titulo,$mensajeCompleto,$headers);
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
        $this->load->model('Porvalidar_model');
        $correo = $this->input->post('email');
        $data['correito'] = $correo;
        if( $this->Porvalidar_model->insertData($correo)){
          $this->load->view('templates/header');
          $this->load->view('codigo/medico',$data);
          $this->load->view('templates/footer2');
        }
        else{
          return false;
        }
      }

      public function dataPost(){
        $this->load->model('Porvalidar_model');
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

        if( $this->Porvalidar_model->insertData($nombre, $correo, $medico, $cedula, $justificacion)){
          $this->load->view('templates/header', $data);
          $this->load->view('codigo/mensaje',$data);
          $this->load->view('templates/footer2');
        }
        else{
          return false;
        }
      }
      /**
      * La siguiente funcion es para cuando le de click el administrados
      * en el boton de envio de codigo se actualize el status a 1 para que deje de aparecer y ademas
      * borre toda la linea
      *
      *
      **/
      public function actualizaStatus(){
        // se carga el modelo
        $this->load->model('Porvalidar_model');
        $id = $this->input->post('ids');
        $correo = $this->input->post('correo');
        $this->Porvalidar_model->actualizaStatus($correo, $id);
      }
      public function negado(){
        $this->load->model('Porvalidar_model');
        $correo = $this->input->post('correo');
        $id = $this->input->post('ids');
        $this->Porvalidar_model->negado($correo, $id);
      }
      public function mensajeStatus(){
        $this->load->model('Porvalidar_model');
        $correo -> $this->input->post('correo');
        $this->Porvalidar_model->actualizaStatus($correo);
      }
  }
?>
