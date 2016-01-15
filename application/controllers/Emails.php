<?php
  /**
  * Controlador para el envío de correos masivos
  * a una cierta muestra de medicos
  *
  */
  class Emails extends CI_Controller{
    public function __construct(){
      parent::__construct();
      //carga el modelo
      $this->load->model('Emails_model');
    }
    /**
    * funcion publica que es la que trae todos los medicos, en este caso sera una cantidad
    * 500 medicos.
    * @param codigo: aleatorio
    * @param plantilla: plantilla la que se va a enviar por correo
    * @param body: cuerpo del mensaje masivo
    * @param
    **/
    public function masivos( $codigo, $plantilla, $body ){
    }
    /**
    * function traerMails, esta funcion servira para traer los e-mails
    * de forma aleatoria, y los mostrara en la tabla con su respectivo codigo aleatorio
    **/
    public function traeMails(){
      echo json_encode($this->Emails_model->traeMails());
    }
    //trae todos los correos para su envio
    public function getMails(){
      echo json_encode( $this->Emails_model->getMails() );
    }
    // trae los correos contestados
    public function getMailsSends(){
      echo json_encode( $this->Emails_model->getMailsSends() );
    }
    // esta funcion es para el envio de mails
    public function passofHel(){
      $correo = $this->input->post('correo');
      $nombres = $this->input->post('nombres');
      $cuerpo = $this->input->post('cuerpo');
      echo json_encode( $this->Emails_model->passofHel($correo, $nombres, $cuerpo));
    }
  }
?>
