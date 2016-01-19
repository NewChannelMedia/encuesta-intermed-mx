<?php
  /**
  * Controlador para trabajar con la informacion que puede ver los administradores,
  * del sitio, la tabla para aceptar las solicitudes que nos lleguen.
  * Se usaran sessiones para los usuarios
  *
  */
  class Admin extends CI_Controller
  {
    public function __construct(){
      parent::__construct();
      $this->load->model('Encuestam_model');
      $this->load->model('Categorias_model');
      $this->load->model('Preguntasm_model');
      $this->load->model('Respuestasm_model');
      $this->load->model('Porvalidar_model');
      $this->load->model('Newsletter_model');
      $this->load->model('Contacto_model');
      $this->load->model('Capcapturista_model');
      header('Cache-Control: no cache');
    }

      // carga del constructor
      public function index(){
        if (isset($_SESSION['status']) && $_SESSION['status']!=false){
          redirect(base_url() . 'admin/control');
        } else {
          $data['title'] = "Administradores";
          $data['login_status'] = true;
          $data['errorM'] = "";
          $this->load->view('templates/header', $data);
          $this->load->view('admin/Admin_vista');
          $this->load->view('templates/footer2');
        }
      }

      public function control(){
          // se carga el modelo para verificar si existen el usuario y password que se reciben por post
          $this->load->model('Admin_model');
          // se atrapan los post del formulario
          $usuario = $this->input->post('user');
          $password = $this->input->post('password');

          if ($usuario != '' && $password != ''){
            $session = $this->Admin_model->login($usuario, $password);

            if ($session != false){
              $_SESSION['status'] = true;
              $_SESSION['usuario'] = $session['usuario'];
              $_SESSION['rol'] = $session['rol'];
              $_SESSION['id'] = $session['id'];
            } else {
              session_destroy();
            }
          }

          if(isset($_SESSION['status']) && $_SESSION['status'] === true){
            if ($_SESSION['rol'] == "capturista"){
              redirect(base_url() . 'admin/directorio');
            }
            $data['title'] = "Dashboard";
            $data['administrador'] = $usuario;
            $data['user'] = $usuario;
            $data['session'] = $_SESSION['status'];
            $data['errorM'] = "";

            $data['totalContestadas'] = $this->Encuestam_model->get_totalEncuestasM()['total'];
            $data['totalPorValidar'] = $this->Porvalidar_model->get_totalPorValidar()['total'];
            $data['totalMensajes'] = $this->Contacto_model->get_totalNuevos()['total'];
            $data['totalNewsletter'] = $this->Newsletter_model->get_totalNewsletter()['total'];

            /*GRAFICA ENCUESTAS POR FECHA*/
            /*
            $porfecha = $this->Encuestam_model->get_totalEncuestasMPorFecha();
            $env = array();
            foreach ($porfecha as $key => $value) {
              $env[] = array('label' => $value['fecha'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_encuestasPorPeriodo', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartLine('.json_encode($enviar).') })</script>';
            $data['drop_encPer'] = encuestas_dropDown($enviar,'Line');

            /*GRAFICA PRECIOS PROPUESTOS*/
            /*
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(40);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_preciosPropuestos', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartPolar('.json_encode($enviar).') })</script>';
            $data['drop_precios'] = encuestas_dropDown($enviar,'Polar');
            /*GRAFICA POR ESPECIALIDADES*/
            /*
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(1);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_especialidades', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartBar('.json_encode($enviar).') })</script>';
            $data['drop_especialidades'] = encuestas_dropDown($enviar,'Bar');
            /*GRAFICA POR NIVEL DE INFLUENCIA DE LA TECNOLOGIA EN LA VIDA PROFESIONAL*/
            /*
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(4);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_influenciaTecnologia', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartRadar('.json_encode($enviar).') })</script>';
            $data['drop_tecnologia'] = encuestas_dropDown($enviar,'Radar');
            /*GRAFICA POR EDADES*/
            /*
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(2);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_edades', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartPie('.json_encode($enviar).') })</script>';
            $data['drop_edades'] = encuestas_dropDown($enviar,'Pie');
            /*GRAFICA POR DISPOSITIVOS*/
            /*
            $respuestas = $this->Respuestasm_model->get_dispositivos();
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['dispositivo'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_dispositivos', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartDoughnut('.json_encode($enviar).') })</script>';
            $data['drop_dispositivos'] = encuestas_dropDown($enviar,'Doughnut');
            */
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
          if (isset($_SESSION['status'])){
            $session = $_SESSION['status'];
          } else {
            $session = false;
          }
          if($session===true){
            $data['title'] = "Solicitudes";
            $data['errorM'] = "";
            $this->load->view('templates/headerAdmin', $data);
            $this->load->view('admin/solicitudes', $data);
            $this->load->view('templates/footerAdmin');
          }else{
            $data['title'] = "Solicitudes";
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
        unset($_SESSION);
        session_destroy();
        $data['errorM'] = "";
        $data['title'] = "Admin";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/Admin_vista', $data);
        $this->load->view('templates/footer2');
        redirect(base_url() . 'admin');
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
          $aceptar[$i]['mensaje'] = $row->mensaje;
          $i++;
        }
        print_r(json_encode($aceptar));
      }

      public function suscritos(){
        $this->load->model('Admin_model');
        $query = $this->Admin_model->suscripcionNewsletter();
        $newsletter = array();
        $i = 0;
        $data['title'] = "Suscritos";
        foreach( $query->result() as $row ){
          $newsletter[$i]['id'] = $row->id;
          $newsletter[$i]['nombre'] = $row->nombre;
          $newsletter[$i]['correo'] = $row->correo;
          $newsletter[$i]['newsletter'] = $row->news;
          $newsletter[$i]['pruebas'] = $row->pruebas;
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

      public function consultacrossreference(){
        $consultas = $this->input->post('consultas');
        $universo = $this->Encuestam_model->get_totalEncuestasM()['total'];
        $data = array('universo'=>$universo);
        foreach ($consultas as $key => $query) {
          $pregunta = '';

          $explode = explode('_',$query['pregunta']);
          $pregunta_id = explode('_',$query['pregunta'])[1];
          $pregunta = $this->Preguntasm_model->get_preguntam($pregunta_id);
          if (count($explode) === 2){
            $pregunta = $pregunta['pregunta'];
          }
          else {
            $explode2 = explode('|',$pregunta['opciones']);
            $pregunta = $explode2[$explode[3]];
          }
          $pregunta = $query['label'];
          $data['preguntas'][$pregunta] = $this->Respuestasm_model->get_ejecutarConsulta($query['query'])['total'];
        }
        echo json_encode($data);
      }

      // ---------------
      public function resultados(){
        if(!file_exists('application/views/resultados/index.php')){
          show_404();
        }

        $resultado = array();

        $categorias = $this->Categorias_model->get_categorias();

        $total = 0;
        foreach ($categorias as $cat) {
            if ($cat['id']>0 && $cat['etapa']>0){
            $categoriasArray = array();
            $categoriasArray['name'] = $cat['categoria'];
            $preguntas = $this->Preguntasm_model->get_preguntamByCategoria($cat['id']);
            $preguntasArray = array();
            foreach ($preguntas as $preg) {
                $pregArray = array();
                $pregArray['pregunta'] = $preg['pregunta'];
                $pregArray['respuestas'] = array();
                $respuestas = $this->Respuestasm_model->get_respuestamByPregunta($preg['id']);
                $opciones = array();
                $resultadoTextEnum = array();
                $resultadoRadioComplemento = array();
                if ($preg['tipo'] == 'text|enum'){
                  $opciones = explode('|', $preg['opciones'] );
                  $num = 0;
                  foreach ($opciones as $key) {
                    $value = $key;
                    if (substr($key,-1) == ':'){
                      $opciones[$num] = substr($key,0,strlen($key)-1);
                      $num++;
                      $value = $opciones[$num];
                    }
                    if (strlen($value) > 0){
                      $resultadoTextEnum[$value] = 0;
                    }
                  }
                } else if ($preg['tipo'] == 'checkbox' || $preg['tipo'] == 'checkbox'){
                  $opciones = explode('|', $preg['opciones'] );
                  foreach ($opciones as $key) {
                    $resultadoTextEnum[$key] = array();
                    $resultadoRadioComplemento[$key] = 0;
                  }
                }

                foreach ($respuestas as $resp) {
                  $respFinal = array();

                  if ($preg['tipo'] == "radio"){

                    $resp['respuesta'] = explode('|comp:', $resp['respuesta']);

                    if (count($resp['respuesta']) == 1){
                      $resultadoRadioComplemento[$resp['respuesta'][0]] = $resp['total'];
                    } else {
                      $resp['respuesta'][1] = strtolower($resp['respuesta'][1]);
                      if (array_key_exists($resp['respuesta'][0],$resultadoRadioComplemento)){
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] =  $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] + $resp['total'];
                        if (array_key_exists($resp['respuesta'][1], $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'])){
                          $cant =   $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]];
                          $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $cant + $resp['total'];
                        } else {
                          $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $resp['total'];
                        }
                      } else {
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] = $resp['total'];
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $resp['total'];
                      }
                    }
                    $respFinal['respuesta'] = $resultadoRadioComplemento;
                    $pregArray['respuestas'][0] = $respFinal;

                  } elseif ($preg['tipo'] == "text|enum"){
                    //SPLIT con |
                    $resp['respuesta'] = explode('|', $resp['respuesta'] );
                    for ($i = 0; $i < count($resp['respuesta']); $i++) {
                      if (array_key_exists($opciones[$i],$resultadoTextEnum)){
                        $resultadoTextEnum[$opciones[$i]] = $resultadoTextEnum[$opciones[$i]] + (count($opciones) + 1 - $resp['respuesta'][$i]);
                      } else {
                        $resultadoTextEnum[$opciones[$i]] = (count($opciones) + 1 - $resp['respuesta'][$i]);
                      }
                    }
                    arsort($resultadoTextEnum);
                    $respFinal['respuesta'] = $resultadoTextEnum;
                    $respFinal['total'] = '';
                    $pregArray['respuestas'][0] = $respFinal;
                  } elseif ($preg['tipo'] == "checkbox"){
                    $resp['respuesta'] = explode('|', $resp['respuesta'] );
                    for ($i = 0; $i < count($resp['respuesta']); $i++) {
                      if (stripos($resp['respuesta'][$i],'comp:') === false){
                        $respuestaf = $resp['respuesta'][$i];
                        $complemento = '';
                        if (substr($resp['respuesta'][$i],-1) == ":" && array_key_exists($i+1,$resp['respuesta']) && stripos($resp['respuesta'][$i+1],'comp:') === 0){
                            $complemento = explode('comp:',$resp['respuesta'][$i+1])[1];
                        }
                        if (!empty($respuestaf) && $respuestaf != ""){
                          if (array_key_exists($respuestaf,$resultadoTextEnum)){
                            if (!(array_key_exists('total',$resultadoTextEnum[$respuestaf]))){
                              $resultadoTextEnum[$respuestaf]['total'] = 0;
                            }
                            $cant = intval($resultadoTextEnum[$respuestaf]['total']);
                            $resultadoTextEnum[$respuestaf]['total'] = $cant + $resp['total'];
                          } else {
                            $resultadoTextEnum[$respuestaf]['total'] =  $resp['total'];
                          }
                          if (!empty($complemento)){
                            if (!array_key_exists('comp',$resultadoTextEnum[$respuestaf])){
                              $resultadoTextEnum[$respuestaf]['comp'] = array();
                            }
                            if (array_key_exists($complemento,$resultadoTextEnum[$respuestaf]['comp'])){
                              $cant = intval($resultadoTextEnum[$respuestaf]['comp'][$complemento]);
                              $resultadoTextEnum[$respuestaf]['comp'][$complemento] = $cant +  $resp['total'];
                            } else {
                              $resultadoTextEnum[$respuestaf]['comp'][$complemento] =  $resp['total'];
                            }
                          }
                        }
                      }
                    }
                    arsort($resultadoTextEnum);
                    $respFinal['respuesta'] = $resultadoTextEnum;
                    $respFinal['total'] = '';
                    $pregArray['respuestas'][0] = $respFinal;
                  } else {
                    $respFinal['respuesta'] = $resp['respuesta'];
                    $respFinal['total'] = $resp['total'];
                    $pregArray['respuestas'][] = $respFinal;
                  }
                }
                $preguntasArray[] = $pregArray;
            }
            $categoriasArray['preguntas'] = $preguntasArray;
            $resultado[] = $categoriasArray;
          }
        }

        $data = array('resultado'=> $resultado);
        $data['title'] = "Resultados";

        $this->load->view('templates/headerAdmin', $data);
        $this->load->view('admin/resultados', $data);
        $this->load->view('templates/footerAdmin', $data);

      }

      public function crossreference(){
        if(!file_exists('application/views/resultados/index.php')){
          show_404();
        }

        $resultado = array();

        $categorias = $this->Categorias_model->get_categorias();

        $total = 0;
        foreach ($categorias as $cat) {
            if ($cat['id']>0 && $cat['etapa']>0){
            $categoriasArray = array();
            $categoriasArray['name'] = $cat['categoria'];
            $preguntas = $this->Preguntasm_model->get_preguntamByCategoria($cat['id']);
            $preguntasArray = array();
            foreach ($preguntas as $preg) {
                $pregArray = array();
                $pregArray['pregunta'] = $preg['pregunta'];
                $pregArray['tipo'] = $preg['tipo'];
                $pregArray['id'] = $preg['id'];
                $pregArray['respuestas'] = array();
                $respuestas = $this->Respuestasm_model->get_respuestamByPregunta($preg['id']);
                $opciones = array();
                $resultadoTextEnum = array();
                $resultadoRadioComplemento = array();
                if ($preg['tipo'] == 'text|enum'){
                  $opciones = explode('|', $preg['opciones'] );
                  $num = 0;
                  foreach ($opciones as $key) {
                    $value = $key;
                    if (substr($key,-1) == ':'){
                      $opciones[$num] = substr($key,0,strlen($key)-1);
                      $num++;
                      $value = $opciones[$num];
                    }
                    if (strlen($value) > 0){
                      $resultadoTextEnum[$value] = 0;
                    }
                  }
                } else if ($preg['tipo'] == 'checkbox' || $preg['tipo'] == 'checkbox'){
                  $opciones = explode('|', $preg['opciones'] );
                  foreach ($opciones as $key) {
                    $resultadoTextEnum[$key] = array();
                    $resultadoRadioComplemento[$key] = 0;
                  }
                }

                foreach ($respuestas as $resp) {
                  $respFinal = array();

                  if ($preg['tipo'] == "radio"){

                    $resp['respuesta'] = explode('|comp:', $resp['respuesta']);

                    if (count($resp['respuesta']) == 1){
                      $resultadoRadioComplemento[$resp['respuesta'][0]] = $resp['total'];
                    } else {
                      $resp['respuesta'][1] = strtolower($resp['respuesta'][1]);
                      if (array_key_exists($resp['respuesta'][0],$resultadoRadioComplemento)){
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] =  $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] + $resp['total'];
                        if (array_key_exists($resp['respuesta'][1], $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'])){
                          $cant =   $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]];
                          $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $cant + $resp['total'];
                        } else {
                          $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $resp['total'];
                        }
                      } else {
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['total'] = $resp['total'];
                        $resultadoRadioComplemento[$resp['respuesta'][0]]['comp'][$resp['respuesta'][1]] = $resp['total'];
                      }
                    }
                    $respFinal['respuesta'] = $resultadoRadioComplemento;
                    $pregArray['respuestas'][0] = $respFinal;

                  } elseif ($preg['tipo'] == "text|enum"){
                    //SPLIT con |
                    $resp['respuesta'] = explode('|', $resp['respuesta'] );
                    for ($i = 0; $i < count($resp['respuesta']); $i++) {
                      if (array_key_exists($opciones[$i],$resultadoTextEnum)){
                        $resultadoTextEnum[$opciones[$i]] = $resultadoTextEnum[$opciones[$i]] + (count($opciones) + 1 - $resp['respuesta'][$i]);
                      } else {
                        $resultadoTextEnum[$opciones[$i]] = (count($opciones) + 1 - $resp['respuesta'][$i]);
                      }
                    }
                    arsort($resultadoTextEnum);
                    $respFinal['respuesta'] = $resultadoTextEnum;
                    $respFinal['total'] = '';
                    $pregArray['respuestas'][0] = $respFinal;
                  } elseif ($preg['tipo'] == "checkbox"){
                    $resp['respuesta'] = explode('|', $resp['respuesta'] );
                    for ($i = 0; $i < count($resp['respuesta']); $i++) {
                      if (stripos($resp['respuesta'][$i],'comp:') === false){
                        $respuestaf = $resp['respuesta'][$i];
                        $complemento = '';
                        if (substr($resp['respuesta'][$i],-1) == ":" && array_key_exists($i+1,$resp['respuesta']) && stripos($resp['respuesta'][$i+1],'comp:') === 0){
                            $complemento = explode('comp:',$resp['respuesta'][$i+1])[1];
                        }
                        if (!empty($respuestaf) && $respuestaf != ""){
                          if (array_key_exists($respuestaf,$resultadoTextEnum)){
                            if (!(array_key_exists('total',$resultadoTextEnum[$respuestaf]))){
                              $resultadoTextEnum[$respuestaf]['total'] = 0;
                            }
                            $cant = intval($resultadoTextEnum[$respuestaf]['total']);
                            $resultadoTextEnum[$respuestaf]['total'] = $cant + $resp['total'];
                          } else {
                            $resultadoTextEnum[$respuestaf]['total'] =  $resp['total'];
                          }
                          if (!empty($complemento)){
                            if (!array_key_exists('comp',$resultadoTextEnum[$respuestaf])){
                              $resultadoTextEnum[$respuestaf]['comp'] = array();
                            }
                            if (array_key_exists($complemento,$resultadoTextEnum[$respuestaf]['comp'])){
                              $cant = intval($resultadoTextEnum[$respuestaf]['comp'][$complemento]);
                              $resultadoTextEnum[$respuestaf]['comp'][$complemento] = $cant +  $resp['total'];
                            } else {
                              $resultadoTextEnum[$respuestaf]['comp'][$complemento] =  $resp['total'];
                            }
                          }
                        }
                      }
                    }
                    arsort($resultadoTextEnum);
                    $respFinal['respuesta'] = $resultadoTextEnum;
                    $respFinal['total'] = '';
                    $pregArray['respuestas'][0] = $respFinal;
                  } else {
                    $respFinal['respuesta'] = $resp['respuesta'];
                    $respFinal['total'] = $resp['total'];
                    $pregArray['respuestas'][] = $respFinal;
                  }
                }
                $preguntasArray[] = $pregArray;
            }
            $categoriasArray['preguntas'] = $preguntasArray;
            $resultado[] = $categoriasArray;
          }
        }

        $data = array('resultado'=> $resultado);
        $data['title'] = "Resultados";

        $this->load->view('templates/headerAdmin', $data);
        $this->load->view('admin/crossreference', $data);
        $this->load->view('templates/footerAdmin', $data);
      }



      public function mensajes(){
        $this->load->model('Admin_model');
        $query = $this->Contacto_model->get_mensajes();
        $this->Contacto_model->set_leidos();
        $mensajes = array();
        $i = 0;
        $data['title'] = "Mensajes";
        $data['mensajes'] = $query;

        $this->load->view('templates/headerAdmin', $data);
        $this->load->view('admin/mensajes', $data);
        $this->load->view('templates/footerAdmin');
      }

      public function enviarCorreo(){
          $titulo = 'Mensaje de Intermed';
          $id = $this->input->post('id');
          $correo = $this->input->post('email');
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
          $borrar = array(
            '<h1>Este es tu c&oacute;digo de acceso.</h1>',
            '<div class="codigoContainer" style="background-color: white;color: black;font-weight: bold;padding: 10px 20px;margin-top: 45px;margin-bottom: 30px;font-size: 30px;text-transform: uppercase;width: 200px;height: 45px;display: table;display: table-cell;vertical-align: middle;"><span id="codigo"></span></div>'
          );


          $sustituir3 = "<span id='mensaje'><p>".$mensaje."</p></span>";
          $conCodigo5 = str_replace('<span id="mensaje"><p></p></span>',$sustituir3,$html2);
          $conCodigo4 = str_replace($borrar,'',$conCodigo5);
          $mensajeCompleto = $html1.$conCodigo4.$html3;
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-Type:text/html;charset=utf-8" . "\r\n";

          $headers .= 'From: Intermed <hola@intermed.online>'."\r\n";

          $mensajeCompleto = str_replace('Á','&Aacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('É','&Eacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('Í','&Iacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('Ó','&Oacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('Ú','&Uacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('á','&aacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('é','&eacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('í','&iacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('ó','&oacute;',$mensajeCompleto);
          $mensajeCompleto = str_replace('ú','&uacute;',$mensajeCompleto);

          $mensajeCompleto = str_replace('{{{ruta}}}',''.$codigo, $mensajeCompleto);

          $result =  mail($correo,$titulo,$mensajeCompleto,$headers);

          $array = array();
          $array['success'] = $result;
          if ($result){
            $query = $this->Contacto_model->set_respuesta($id,$mensaje);
          }

      		echo json_encode($array);
      }

        public function categorias(){
          $data['etapas'] = $this->Categorias_model->get_etapas();
          //$this->Categorias_model->set_etapas(4);
          $data['categorias'] = $this->Categorias_model->get_categorias();
          $data['title'] = "Administrar categorias";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/adminCat', $data);
          $this->load->view('templates/footerAdmin');
        }

        public function preguntas(){
          $data['categorias'] = $this->Categorias_model->get_categorias();
          $data['preguntas'] = $this->Preguntasm_model->get_preguntasm();
          $data['title'] = "Administrar preguntas";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/adminPreg', $data);
          $this->load->view('templates/footerAdmin');
        }


        public function guardarPregunta(){
          $pregunta_id = $this->input->post('pregunta_id');
          $categoria_id = $this->input->post('categoria_id');
          $pregunta = $this->input->post('pregunta');
          $tipo = $this->input->post('tipo');
          $opciones = $this->input->post('opciones');

          $data = array(
            'pregunta_id' => $pregunta_id,
            'pregunta' => $pregunta,
            'tipo' => $tipo,
            'opciones' => $opciones,
            'categoria_id' => $categoria_id
          );

          if ($pregunta_id != ''){
            //Modificar pregunta
            $result = $this->Preguntasm_model->update_pregunta($data);
          } else {
            //Agregar nueva pregunta
            $result = $this->Preguntasm_model->create_pregunta($data);
            if ($result) $pregunta_id = $result['id'];
          }

          if ($result){
            $success = true;
          } else {
            $success = false;
          }

          $respuesta = array(
             'success' => $success,
             'pregunta_id' => $pregunta_id
          );
          echo json_encode($respuesta);
        }

        public function eliminarPregunta(){
          $id = $this->input->post('id');
          $data = array('id'=>$id);
          $result = $this->Preguntasm_model->delete_pregunta($data);

          $respuesta = array(
             'success' => $result
          );
          echo json_encode($respuesta);
        }

        public function eliminarEtapa(){
          $etapa = $this->input->post('etapa');

          $this->Encuestam_model->delete_etapa($etapa);
          $respuesta = array(
             'success' => true
          );
          echo json_encode($respuesta);
        }

        public function nuevaEtapa(){
          $etapas = $this->Categorias_model->get_etapas();
          $etapas++;
          $this->Categorias_model->set_etapas($etapas);
          $respuesta = array(
             'success' => true
          );
          echo json_encode($respuesta);
        }

        public function nuevaCategoria(){
          $categoria = $this->input->post('categoria');
          $result = $this->Categorias_model->create_categoria($categoria);
          $respuesta = array(
             'success' => $result
          );
          echo json_encode($respuesta);

        }

        public function eliminarCategoria(){
          $categoria_id = $this->input->post('categoria_id');
          $result = $this->Categorias_model->delete_categoria($categoria_id);
          $respuesta = array(
             'success' => $result
          );
          echo json_encode($respuesta);

        }

        public function guardarCambioscategorias(){
          $data = $this->input->post('data');
          $int = 0;
          $data = json_decode(json_encode($data),1);
          foreach ($data as $etapa) {
            $numEt = $etapa['etapa'];
            if (array_key_exists('categorias',$etapa)){
              $categorias = $etapa['categorias'];
              foreach ($categorias as $categoria) {
                $result = $this->Categorias_model->update_etapaCategoria($categoria['id'],$numEt,$int++);
              }
            }
          }
          $result = true;
          $respuesta = array(
             'success' => $result
          );
          echo json_encode($respuesta);
        }
        public function directorio(){
            $this->load->model('Capespecialidades_model');
            $this->load->model('Capubicaciones_model');

            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (array_key_exists('status',$_SESSION)){
              $session = $_SESSION['status'];
            } else {
              $session = false;
            }
            if($session===true){
              $data['title'] = "Directorio";
              $data['errorM'] = "";
              $data['especialidades'] = $this->Capespecialidades_model->get_especialidades();
              $data['estados'] = $this->Capubicaciones_model->get_estados();
              //$data['rol'] = "admin";
              $data['rol'] = "capturista";
              $this->load->view('templates/headerAdmin', $data);
              $this->load->view('admin/directorio', $data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }
        public function anadirCapturista(){
            if (array_key_exists('status',$_SESSION)){
              $session = $_SESSION['status'];
            } else {
              $session = false;
            }
            if($session===true){
              $data['title'] = "Capturista";
              $data['errorM'] = "";
              //$data['rol'] = "admin";
              $data['rol'] = "admin";
              $this->load->view('templates/headerAdmin', $data);
              $this->load->view('admin/anadirCapturista', $data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }
        public function llamadas(){
            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (isset($_SESSION) && isset($_SESSION['status']))
            $session = $_SESSION['status'];
            else $session = false;
            if($session===true){
              $this->load->model('Capmuestramed_model');
              $data['total'] = $this->Capmuestramed_model->get_countMuestra_llamadas();
              $data['title'] = "Directorio";
              $data['errorM'] = "";
              $data['rol'] = "capturista";
              $this->load->view('templates/headerAdmin', $data);
              $this->load->view('admin/llamadas', $data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }

        public function registrados(){
          $this->load->model('Capespecialidades_model');
          $this->load->model('Capubicaciones_model');
          $data['estados'] = $this->Capubicaciones_model->get_estados();
          $data['especialidades'] = $this->Capespecialidades_model->get_especialidades();
          $data['title'] = "Médicos registrados";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/registrados', $data);
          $this->load->view('templates/footerAdmin');
        }

        public function registradosDelDia(){
          $this->load->model('Capespecialidades_model');
          $this->load->model('Capubicaciones_model');
          $data['estados'] = $this->Capubicaciones_model->get_estados();
          $data['especialidades'] = $this->Capespecialidades_model->get_especialidades();
          $data['title'] = "Médicos registrados";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/registradosDelDia', $data);
          $this->load->view('templates/footerAdmin');
        }

        public function statusCapturista(){
          $query = $this->Capcapturista_model->cargandoInfo();
          $i = 0;
          $arr = array();
          foreach( $query->result() as $row ){
            $arr[ $i ]['id'] = $row->id;
            $arr[ $i ]['id_maestro'] = $row->id_master;
            $arr[ $i ]['nombre'] = $row->nombre;
            $arr[ $i ]['apellido'] = $row->apellido;
            $arr[ $i ]['correo'] = $row->correo;
            $arr[ $i ]['usuario'] = $this->Capcapturista_model->usuarioInfo($row->id_master);
            $arr[ $i ]['RegistrosHoy'] = $this->Capcapturista_model->RegistrosHoy($row->id_master);
            $arr[ $i ]['Registros'] = $this->Capcapturista_model->Registros($row->id_master);
            $arr[ $i ]['RegistrosAyer'] = $this->Capcapturista_model->RegistrosAyer($row->id_master);
            $arr[ $i ]['RegistrosHoyLlamadasAut'] = $this->Capcapturista_model->RegistrosHoyLlamadasAut($row->id_master);
            $arr[ $i ]['RegistrosLlamadasAut'] = $this->Capcapturista_model->RegistrosLlamadasAut($row->id_master);
            $arr[ $i ]['RegistrosHoyLlamadasNoAut'] = $this->Capcapturista_model->RegistrosHoyLlamadasNoAut($row->id_master);
            $arr[ $i ]['RegistrosLlamadasNoAut'] = $this->Capcapturista_model->RegistrosLlamadasNOAut($row->id_master);
            $arr[ $i ]['RegistrosLlamadasAnteriores'] = $this->Capcapturista_model->RegistrosLlamadasAnteriores($row->id_master);
            $arr[ $i ]['totalFechasLlamadas'] = $this->Capcapturista_model->LlamadasTotalFechas($row->id_master);
            $i++;
           }
          $data['capturistas'] = $arr;
          $data['title'] = "Status de Capturistas";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/capturistaStatus', $data);
          $this->load->view('templates/footerAdmin');
        }
        //inserta en la tabla master de la db capturista los datos
        public function usuarioPassword(){
          // se atrapa por post las variables enviadas por el ajax
          $user = $this->input->post('usuario');
          $password = $this->input->post('password');
        }

        public function revisados(){
          $this->load->model('Capespecialidades_model');
          $this->load->model('Capubicaciones_model');
          //test
          $data['estados'] = $this->Capubicaciones_model->get_estados();
          $data['especialidades'] = $this->Capespecialidades_model->get_especialidades();
          $data['title'] = "Médicos registrados";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/revisados', $data);
          $this->load->view('templates/footerAdmin');
        }
        public function masivos(){
          $this->load->model('Capmuestramed_model');
         $data['total'] = $this->Capmuestramed_model->get_muestra_correosM();
         $data['title'] = "Envio masivo";
         $this->load->view( 'templates/headerAdmin',$data );
         $this->load->view( 'admin/masivos');
         $this->load->view( 'templates/footerAdmin' );
       }

        public function correo(){
            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (isset($_SESSION) && isset($_SESSION['status']))
            $session = $_SESSION['status'];
            else $session = false;
            if($session===true){
              $this->load->model('Capmuestramed_model');
              $data['total'] = $this->Capmuestramed_model->get_countMuestra_correos();
              $data['title'] = "Directorio";
              $data['errorM'] = "";
              $data['rol'] = "capturista";
              $this->load->view('templates/headerAdmin', $data);
              $this->load->view('admin/correo', $data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }

        public function invitacionDirecta(){
            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (isset($_SESSION) && isset($_SESSION['status']))
              $session = $_SESSION['status'];
            else $session = false;
            if($session===true){
              $data = array();
              $data['title'] = "Invitación directa";
              $this->load->view('templates/headerAdmin',$data);
              $this->load->view('admin/invDirecta',$data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }

        public function enviarEncuestaDirecta(){
          $nombre = $this->input->post('nombre');
          $correo = $this->input->post('correo');


          $mensaje = "<p>Estimado Dr.(a), agradecemos tu tiempo y tu atenci&oacute;n a la presente.</p><p>Est&aacute;s recibiendo este correo como una invitaci&oacute;n a participar en el desarrollo de <strong>Intermed<sup>&reg;</sup></strong>.</p><p><strong>Intermed<sup>&reg;</sup></strong> es una plataforma que conecta a los principales participantes del ecosistema de la salud, otorgando a cada uno de ellos herramientas que ayudan a agilizar y modernizar los procesos relacionados con su trabajo, mejorar su comunicaci&oacute;n y permitir un mayor control sobre el estado de su salud a los pacientes.</p><p>Como parte de nuestro proceso de desarrollo, queremos mantener un contacto cercano con nuestros futuros usuarios, de los cuales t&uacute; formas parte importante, y como tal, queremos conocer tu opini&oacute;n.</p><p>A continuaci&oacute;n, hemos incluido un c&oacute;digo de acceso exclusivo, que te permitir&aacute; acceder a 3 peque&ntilde;os videos informativos que hemos preparado para ti, a trav&eacute;s de los cuales podr&aacute;s conocer las funciones de <strong>Intermed<sup>&reg;</sup></strong>.</p><p>Rogamos tu apoyo para contestar la encuesta incluida al finalizar los videos.</p><p>Tu participaci&oacute;n es de gran importancia para nuestro proyecto, ya que nos ayudar&aacute; a finalizar de adaptar y definir la funcionalidad de <strong>Intermed<sup>&reg;</sup></strong> de acuerdo a tus necesidades y expectativas.</p><p>Recibe un afectuoso saludo.<br>Atte: Jorge Alejandro Preciado.<br>CEO Intermed<sup>&reg;</sup></p>";

          $result = $this->enviarCorreoPersonalizado($nombre, $correo, 6,$mensaje);

          if ($result){
            //Insertar en la base de datos el envio a encuesta directa (porValidar status = 2)
            $this->Porvalidar_model->insertarEnvioDirecto($nombre,$correo, 6);
          }
          $array = array(
            'success'=>$result,
            'result' => array(
              'nombre'=>$nombre,
              'correo'=>$correo,
              'fecha' =>date('Y-m-d H:i:s')
            )
          );
          echo json_encode($array);
        }


        public function enviarCorreoPersonalizado($nombre, $correo,$tipoCanal = null, $mensaje = '', $nombreDoc = '', $titulo = 'Mensaje de Intermed'){
            //Cambiar vista correo
            $codigo = '';
            if ($tipoCanal != null){
              $codigo = $this->generarCodigo($tipoCanal);
            }

            // se lee el archivo
            $fileh = realpath(APPPATH.'views/correos/headerMasivo.php');
            $fileb = realpath(APPPATH.'views/correos/correoPersonalizado.php');
            $filef = realpath(APPPATH.'views/correos/footerMasivo.php');
            $fpH = fopen( $fileh,'r');
            $fpB = fopen( $fileb,'r');
            $fpF = fopen( $filef,'r');
            $mensajeCompleto = "";
            while( $line = fgets($fpH) ){
              $mensajeCompleto .= $line;
            }
            while( $line = fgets($fpB) ){
              $mensajeCompleto .= $line;
            }
            while( $line = fgets($fpF) ){
              $mensajeCompleto .= $line;
            }
            fclose($fpH);
            fclose($fpB);
            fclose($fpF);

            //Reemplazar nombre de médico
            if ($nombre != ""){
              $nombre .= '.';
            }
            $mensajeCompleto = str_replace('<span id="nombreDoc"></span>',$nombre,$mensajeCompleto);

            if ($nombreDoc != ""){
              $mensajeDoc = '<div id="mensajeMasivo" style="margin:20px;"><p>Hemos invitado con anterioridad al Dr(a). '. $nombreDoc .', y ahora el te invita a conocer Intermed<sup>&reg;</sup>, la red social de la salud.</p>{{{mensajeDoc}}}</p>';
              $mensajeCompleto = str_replace('{{{mensajeMasivo}}}',$mensajeDoc,$mensajeCompleto);
              if ($mensaje != ""){
                //Agregar mensaje
                $mensaje = '<blockquote style="text-align: center;margin-top: 50px;color: #999999;"><q><em>'.$mensaje.'</em></q><footer>&#8212; Dr(a). '. $nombreDoc .'</footer></blockquote>';
              }
              $mensajeCompleto = str_replace('{{{mensajeDoc}}}',$mensaje,$mensajeCompleto);
            } else {
              $mensajeCompleto = str_replace('{{{mensajeMasivo}}}',$mensaje,$mensajeCompleto);
            }

            $mensajeCompleto = str_replace('{{{codigo}}}',$codigo,$mensajeCompleto);

            $mensajeCompleto = str_replace('Á','&Aacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('É','&Eacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('Í','&Iacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('Ó','&Oacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('Ú','&Uacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('á','&aacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('é','&eacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('í','&iacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('ó','&oacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('ú','&uacute;',$mensajeCompleto);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'Bcc: encuestas@newchannel.mx'."\r\n";
            $headers .= 'From: Intermed <encuesta@intermed.online>'."\r\n";

            return mail($correo,$titulo,$mensajeCompleto,$headers);
        }

        public function generarCodigo($canal){
          $this->load->model('Encuestam_model');
          $posible = str_split("abcdefghijklmnopqrstuvwxyz0123456789");
          shuffle($posible);
          $codigo = array_slice($posible, 0,6);
          $str = implode('', $codigo);
          while ($this->Encuestam_model->get_encuestamId($str)>0){
            shuffle($posible);
            $codigo = array_slice($posible, 0,6);
            $str = implode('', $codigo);
          }
          $this->Encuestam_model->create_encuestam($str,$canal);
          return $str;
        }

        public function enviadosCanalDirectos(){
          $this->load->model('Admin_model');
          $result = $this->Admin_model->enviadosCanalDirectos();
          echo json_encode($result);
        }

        public function enviarEncuestaRecomendada(){
          $destinatarios = $this->input->post('destinatarios');
          $mensaje = $this->input->post('mensaje');
          $nombreDoc = $this->input->post('tunombre');
          $result = true;
          foreach ($destinatarios as $destinatario) {
            if ($result){
              $nombre = $destinatario['nombre'];
              $correo = $destinatario['correo'];
              $result = $this->enviarCorreoPersonalizado($nombre, $correo, 5, $mensaje, $nombreDoc);
              if ($result){
                //Insertar en la base de datos el envio a encuesta directa (porValidar status = 2)
                $this->Porvalidar_model->insertarEnvioRecomendado($nombre,$correo,$mensaje);
              }
            }
          }
          $array = array(
            'success'=>$result
          );
          echo json_encode($array);
        }


        public function invitacionRecomendada(){
            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (isset($_SESSION) && isset($_SESSION['status']))
              $session = $_SESSION['status'];
            else $session = false;
            if($session===true){
              $data = array();
              $data['title'] = "Invitación recomendada";
              $this->load->view('templates/headerAdmin',$data);
              $this->load->view('admin/invRecom',$data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }

        public function enviadosCanalRecomendados(){
          $this->load->model('Admin_model');
          $result = $this->Admin_model->enviadosCanalRecomendados();
          echo json_encode($result);
        }


        public function reenvios(){
            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (isset($_SESSION) && isset($_SESSION['status']))
            $session = $_SESSION['status'];
            else $session = false;
            if($session===true){
              $this->load->model('Capmuestramed_model');
              $data['reenvios'] = $this->Capmuestramed_model->get_reenvios();
              $data['title'] = "Reenvios";
              $data['errorM'] = "";
              $data['rol'] = "capturista";
              $this->load->view('templates/headerAdmin', $data);
              $this->load->view('admin/reenvios', $data);
              $this->load->view('templates/footerAdmin');
            }else{
              $data['title'] = "Directorio";
              $data['error'] = "no sesion";
              $_SESSION['status'] = false;
              $data['status'] = $_SESSION['status'];
              $data['errorM'] = "Revisa tus credenciales de acceso, o la sesión ha sido cerrada.";
              $this->load->view('templates/header', $data);
              $this->load->view('admin/Admin_vista', $data);
              $this->load->view('templates/footerAdmin');
            }
        }

        public function reenviarEncuestas(){
          $this->load->model('Capmuestramed_model');
          $muestraReenviar = $this->input->post('muestraReenviar');
          if (is_array($muestraReenviar)){
            foreach ($muestraReenviar as $muestra) {
              $success = $this->reenviarCodigo($muestra['nombre'], $muestra['correo'],$muestra['codigo']);
              if ($success){
                //Actualizar fechaEnviado de muestra
                $this->Capmuestramed_model->actualizarFechaEnviado($muestra['id']);
              }
              //Dormir medio segundo
              usleep(500000);
            }
          }
          echo json_encode(array('success'=>true));
        }


        public function reenviarCodigo($nombre, $correo, $codigo, $mensaje = ''){
            $titulo = 'Mensaje de Intermed';

            // se lee el archivo
            $fileh = realpath(APPPATH.'views/correos/headerMasivo.php');
            $fileb = realpath(APPPATH.'views/correos/correoPersonalizado.php');
            $filef = realpath(APPPATH.'views/correos/footerMasivo.php');
            $fpH = fopen( $fileh,'r');
            $fpB = fopen( $fileb,'r');
            $fpF = fopen( $filef,'r');
            $mensajeCompleto = "";
            while( $line = fgets($fpH) ){
              $mensajeCompleto .= $line;
            }
            while( $line = fgets($fpB) ){
              $mensajeCompleto .= $line;
            }
            while( $line = fgets($fpF) ){
              $mensajeCompleto .= $line;
            }
            fclose($fpH);
            fclose($fpB);
            fclose($fpF);

            //Reemplazar nombre de médico
            if ($nombre != ""){
              $nombre .= '.';
            }
            $mensajeCompleto = str_replace('<span id="nombreDoc"></span>',$nombre,$mensajeCompleto);

            if ($mensaje != ""){
              echo 'replace msg';
              //Agregar mensaje
              $mensaje = '<p id="mensajeMasivo" style="margin:20px;">'.$mensaje.'</p>';
            }
            $mensajeCompleto = str_replace('{{{mensajeMasivo}}}',$mensaje,$mensajeCompleto);

            $mensajeCompleto = str_replace('{{{codigo}}}',$codigo,$mensajeCompleto);

            $mensajeCompleto = str_replace('Á','&Aacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('É','&Eacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('Í','&Iacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('Ó','&Oacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('Ú','&Uacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('á','&aacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('é','&eacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('í','&iacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('ó','&oacute;',$mensajeCompleto);
            $mensajeCompleto = str_replace('ú','&uacute;',$mensajeCompleto);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'Bcc: encuestas@newchannel.mx'."\r\n";
            $headers .= 'From: Intermed <encuesta@intermed.online>'."\r\n";

            return mail($correo,$titulo,$mensajeCompleto,$headers);
        }

  }

  function encuestas_dropDown($enviar, $tipo){
    $checked = '';
    $data = '';
    $checked = ($tipo == "Bar")? 'checked':'';
    $data .= '<label class="col-md-12"><input type="radio" name="radio'. $enviar['element'] .'" ' . $checked . ' onclick="ChartBar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Barras</label>';
    $checked = ($tipo == "Radar")? 'checked':'';
    $data .= '<label class="col-md-12"><input type="radio" name="radio'. $enviar['element'] .'" ' . $checked . ' onclick="ChartRadar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Radio</label>';
    $checked = ($tipo == "Pie")? 'checked':'';
    $data .= '<label class="col-md-12"><input type="radio" name="radio'. $enviar['element'] .'" ' . $checked . ' onclick="ChartPie('.htmlspecialchars(print_r(json_encode($enviar),1)).')" > Circular</label>';
    $checked = ($tipo == "Doughnut")? 'checked':'';
    $data .= '<label class="col-md-12"><input type="radio" name="radio'. $enviar['element'] .'" ' . $checked . ' onclick="ChartDoughnut('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Dona</label>';
    $checked = ($tipo == "Polar")? 'checked':'';
    $data .= '<label class="col-md-12"><input type="radio" name="radio'. $enviar['element'] .'" ' . $checked . ' onclick="ChartPolar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Polar</label>';
    $checked = ($tipo == "Line")? 'checked':'';
    $data .= '<label class="col-md-12"><input type="radio" name="radio'. $enviar['element'] .'" ' . $checked . ' onclick="ChartLine('.htmlspecialchars(print_r(json_encode($enviar),1)).')" > Linea</label>';
    return $data;
  }

  function capitalize($frase){
    $temp = explode( ' ', $frase );
    $frase = '';
    foreach ($temp as $value) {
      if ($frase != ""){
        $frase .= ' ';
      }
      $frase .= ucfirst(strtolower($value));
    }
    return $frase;
  }
?>
