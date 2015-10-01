<?php
  class Encuesta extends CI_Controller {


    public function __construct(){
      parent::__construct();
      $this->load->model('EncuestasM_Model');
      $this->load->model('Usuarios_Model');
      $this->load->model('Categorias_Model');
      $this->load->model('PreguntasM_Model');
      $this->load->model('RespuestasM_Model');
      $this->load->model('Newsletter_Model');
    }

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

    public function existe(){
      $this->load->helper('url');
      $codigo = $this->input->post('codigo');

      $data = $this->checkStatus($codigo);

      $this->load->view('templates/header', $data);
      /*Cargar la vista correspondiente al status de la encuesta*/
      switch ($data['status']) {
        case 0:
            //No existe la encuesta con ese código
            break;
        case 1:
            //Encuesta sin iniciar
        case 2:
            //Encuesta sin terminar
            $this->load->view('about', $data);
            break;
        case 3:
            //Encuesta ya contestada
            break;
        default:
            break;
      }
      /**/
      $this->load->view('templates/footer', $data);
    }

    public function newsletter(){
      $this->load->helper('url');
      $nombre = $this->input->post('nombre');
      $email = $this->input->post('email');

      $this->Newsletter_Model->create_newsletter($nombre,$email);

      echo 'Hola ' . $nombre. ', ya estas registrado en el newsletter<br/>';
      echo '<a href="/encuesta-intermed-mx">Ir a inicio</a>';

    }

    public function encuesta(){
      $this->load->helper('url');
      $codigo = $this->input->post('codigo');
      $etapaResp = $this->input->post('etapaResp');
      $continuarEnc = $this->input->post('continuar');
      $guardado = false;

      $data = $this->checkStatus($codigo);

      $actualizar = '';
      if ($data['status'] == 1 || $data['status'] == 2){
        //Volver a checar el status de la encuesta
        $data = $this->checkStatus($codigo);
        /*Revisar si hay preguntas por guardar*/
        //post: respuesta_# complemento_# en la encuesta con el codigo $codigo
        //
        $POSTS = $this->input->post();
        //echo 'POSTS: <pre>' . print_r($POSTS,1) . '</pre>';
        $last = '';
        foreach ($POSTS as $post => $value) {
          if (substr($post,0,9) == "respuesta"){
            $id = explode('_', $post)[1];
            if ($last != $id){
              if (array_key_exists("respuesta_" . $id . '_1',$POSTS)){
                $last = $id;
                $next = true;
                $total = 1;
                while ($next == true){
                  if (array_key_exists("respuesta_" . $id . '_' . ++$total,$POSTS)){
                    $value .= '|' . $POSTS["respuesta_" . $id . '_' . $total];
                  } else {
                    $next = false;
                  }
                }
                if (array_key_exists("complemento_" . $id,$POSTS) && !empty($POSTS['complemento_' . $id])){
                  $value .= '|' . $POSTS['complemento_' . $id];
                }
              } else {
                if (array_key_exists("complemento_" . $id,$POSTS) && !empty($POSTS['complemento_' . $id])){
                  $value .= '|' . $POSTS['complemento_' . $id];
                  //echo "Es una respuesta! de la pregunta: ". $id ." y tiene complemento<br/>";
                } else {
                  //echo "Es una respuesta! de la pregunta: ". $id ."<br/>";
                }
              }
              //echo $id . ': ' . $value .'<br/>';
              $update = array(
                 'pregunta_' . $id => $value,
              );
              $resultado = $this->RespuestasM_Model->update_respuestamByEncuesta($data['encuesta_id'], $update);
              //echo 'resultado: ' . $resultado;
              if ($resultado > 0){
                if ($actualizar === '') $actualizar = true;
              } else $actualizar = false;
            }
          }
        }
        if ($actualizar === true){
          $update = array(
            'etapa_' . $etapaResp => 1
          );
          $this->EncuestasM_Model->update_encuestam($data['encuesta_id'], $update);
          $data = $this->checkStatus($codigo);
          $guardado = true;
        }
      }

      echo '$continuarEnc: ' . $continuarEnc;
      if ($continuarEnc === "0"){
        redirect('/encuesta-intermed-mx', 'refresh');
      }

      if ($data['status'] == 1 || $data['status'] == 2){
        $contenido = '<input type="hidden" name="codigo" value="'. $codigo .'">';
        //Mostrar la encuesta
        $this->load->view('templates/header', $data);

        $etapa = '1';
        if (isset($data['paso'])){
          $etapa = $data['paso'];
        }
        $contenido .= '<input type="hidden" name="etapaResp" value="'. $etapa .'">';
        $contenido .= '<div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: '. ($etapa-1)*25 .'%">
                          <span class="sr-only">40% Complete (success)</span>
                        </div>
                      </div>';


        $resultado = $this->Categorias_Model->get_categoriasByEtapa($etapa);

        foreach ($resultado as $categoria) {
          if ($categoria){
            $contenido .= '<hr/><b>' . $categoria['categoria'] . '</b><br/>';
            $preguntas = $this->PreguntasM_Model->get_preguntamByCategoria($categoria['id']);

            foreach ($preguntas as $pregunta) {
                $contenido .= '<br/><li>' . $pregunta['pregunta'] . '</li><br/>';
                $opciones = explode('|', $pregunta['opciones']);
                switch ($pregunta['tipo']) {
                  case 'text':
                      $contenido .= '<input type="text" name="respuesta_' . $pregunta['id'] . '" value="" required >&nbsp;&nbsp;<br/>';
                      break;
                  case 'radio':
                      $total = 0;
                      foreach ($opciones as $opcion) {
                        $contenido .= '<input type="radio" name="respuesta_' . $pregunta['id'] . '" value="' . $opcion . '" required  onchange="LimpiarComplementos('. $pregunta['id'] .','. ++$total .')"> '. $opcion . '&nbsp;&nbsp;';
                        if (substr($opcion, -1) == ":"){
                          $contenido .= '<input type="text" name="complemento_' . $pregunta['id'] . '" id="complemento_' . $pregunta['id'] . '_' . $total . '">';
                        }
                        $contenido .= '&nbsp;&nbsp;';
                      }
                      $contenido .= '<br/>';
                      break;
                  case 'text|enum':
                      $total = 0;
                      $cantidad = count($opciones);
                      foreach ($opciones as $opcion) {
                        $contenido .= '<input type="number" min="0" required max="'. $cantidad .'" name="respuesta_' . $pregunta['id'] . '_' . ++$total . '" > '. $opcion . '&nbsp;&nbsp;';
                        if (substr($opcion, -1) == ":"){
                          $contenido .= '<input type="text" name="complemento_' . $pregunta['id'] . '">';
                        }
                        $contenido .= '&nbsp;&nbsp;';
                      }
                      $contenido .= '<br/>';
                      break;
                  default:
                      break;
                }
            }
            echo '</ul>';
          }
          $data['contenido'] = $contenido;
        }

        $this->load->view('encuesta/encuesta', $data);
        $this->load->view('templates/footer', $data);
      } else if ($data['status'] == 3) {
        if ($guardado){
          $this->load->view('templates/header', $data);
          $contenido = 'Gracias por contestar la encuesta<br/>';
          $contenido .= '<input type="checkbox" id="promo" value="si" onchange="aceptarPromocion()">';
          $contenido .= 'Quiero recibir correos y promociones<br/>';
          $contenido .= '<div id="contenido"></div>';
          $data['contenido'] = $contenido;

          $this->load->view('encuesta/encuesta', $data);
          $this->load->view('templates/footer', $data);
        } else {
          echo 'la encuesta ya se contesto';
        }
        //Redirect /about o index
      } else {
        echo 'la encuesta no existe';
      }

    }

    public function checkStatus($codigo){
      /*
      --STATUS--
      0-La encuesta no existe
      1-La encuesta existe y esta sin usar
      2-La encuesta existe y esta sin terminar
      3-La encuesta existe y ya la terminaron de contenstar
      */
      $data = array();
      $resultado = $this->EncuestasM_Model->get_encuestamByCodigo($codigo);

      $status = -1;
      if ($resultado){
        $data['encuesta_id'] = $resultado['id'];
        $paso = 0;
        if ($resultado['etapa_1'] == 1) $paso = 1;
        if ($resultado['etapa_2'] == 1) $paso = 2;
        if ($resultado['etapa_3'] == 1) $paso = 3;
        if ($resultado['etapa_4'] == 1) $paso = 4;
        if ($paso == 4) $status = 3;
        else if ($paso > 0) {
          $status = 2;
          $data['paso'] = ++$paso;
        } else $status = 1;
      } else {
        $status = 0;
      }

      $data['codigo'] = $codigo;
      $data['status'] = $status;
      return $data;
    }
  }
?>
