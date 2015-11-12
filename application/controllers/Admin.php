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
            $porfecha = $this->Encuestam_model->get_totalEncuestasMPorFecha();
            $env = array();
            foreach ($porfecha as $key => $value) {
              $env[] = array('label' => $value['fecha'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_encuestasPorPeriodo', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartLine('.json_encode($enviar).') })</script>';
            $data['drop_encPer'] = encuestas_dropDown($enviar,'Line');
            /*GRAFICA PRECIOS PROPUESTOS*/
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(40);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_preciosPropuestos', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartPolar('.json_encode($enviar).') })</script>';
            $data['drop_precios'] = encuestas_dropDown($enviar,'Polar');
            /*GRAFICA POR ESPECIALIDADES*/
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(1);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_especialidades', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartBar('.json_encode($enviar).') })</script>';
            $data['drop_especialidades'] = encuestas_dropDown($enviar,'Bar');
            /*GRAFICA POR NIVEL DE INFLUENCIA DE LA TECNOLOGIA EN LA VIDA PROFESIONAL*/
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(4);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_influenciaTecnologia', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartRadar('.json_encode($enviar).') })</script>';
            $data['drop_tecnologia'] = encuestas_dropDown($enviar,'Radar');
            /*GRAFICA POR EDADES*/
            $respuestas = $this->Respuestasm_model->get_respuestamByPregunta(2);
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['respuesta'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_edades', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartPie('.json_encode($enviar).') })</script>';
            $data['drop_edades'] = encuestas_dropDown($enviar,'Pie');
            /*GRAFICA POR DISPOSITIVOS*/
            $respuestas = $this->Respuestasm_model->get_dispositivos();
            $env = array();
            foreach ($respuestas as $key => $value) {
              $env[] = array('label' => $value['dispositivo'], 'value' => $value['total']);
            }
            $enviar = array('element' => 'div_dispositivos', 'data' => $env);
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { ChartDoughnut('.json_encode($enviar).') })</script>';
            $data['drop_dispositivos'] = encuestas_dropDown($enviar,'Doughnut');

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
          $asunto = $this->input->post('asunto');
          $id = $this->input->post('id');
          $email = $this->input->post('email');
          $mensaje = $this->input->post('mensaje');

          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: <intermed.encuestas@newchannel.mx>'."\r\n";

          $result= mail($email,$asunto,$mensaje,$headers);

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
          $data['title'] = "Administrar preguntas";
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
        public function llamadas(){
          /*
            $this->load->model('Capmedicos_model');
                $this->load->model('Captelefonos_model');
            for ($i=0; $i < 3000; $i++) {
              # code...
              $data = array(
                'nombre'=>'Nombre medico '.$i,
                'apellidop'=>'Apellido P',
                'correo' => 'bmdz.acos@gmail.com'
              );
              $this->Capmedicos_model->create_medico($data);

              $data = array(
                'medico_id'=>$i+1,
                'claveRegion'=>'333',
                'numero'=>'777777',
                'tipo'=>'casa'
              );
              $this->Captelefonos_model->create_telefono($data);

              $data = array(
                'medico_id'=>$i+1,
                'claveRegion'=>'111',
                'numero'=>'222222',
                'tipo'=>'oficina'
              );
              $this->Captelefonos_model->create_telefono($data);
            }*/

            // se carga el modelo para verificar si existen el usuario y password que se reciben por post
            $this->load->model('Admin_model');
            if (isset($_SESSION) )
            $session = $_SESSION['status'];
            else $session = false;
            if($session===true){
              $this->load->model('Capmuestramed_model');
              $data['total'] = $this->Capmuestramed_model->get_countMuestra();
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
          $data['especialidades'] = $this->Capespecialidades_model->get_especialidades();
          $data['title'] = "Médicos registrados";
          $this->load->view('templates/headerAdmin', $data);
          $this->load->view('admin/registrados', $data);
          $this->load->view('templates/footerAdmin');
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

?>
