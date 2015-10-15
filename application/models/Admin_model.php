<?php
      /**
      * Modelo para cargar los datos de las tablas que se ocupen de la base de datos
      * en este caso de la tabla porValidar y encuestaM
      *
      *
      *
      */
      class Admin_model extends CI_Model
      {
          public function __construct(){
            $this->load->database();
          }
          /**
          * function que revisara si existe el usuario y el password
          *
          *
          * @param $usuario
          * @param $password
          */
          public function login($usuario, $password){
              $this->db->where('usuario',$usuario);
              $this->db->where('password',$password);
              $query = $this->db->get('master');
              if( $query->num_rows() == 1 ){
                foreach( $query->result() as $row ){
                  if( $row->usuario == $usuario && $row->password == $password )
                    return $row->id;
                  else
                    return false;
                }
              }else{
                return false;
              }
          }
          //retorna toda la tabla para poder ver los que estan por aceptar no @params
          public function porAceptar(){
            $query = $this->db->get('porValidar');
            return $query;
          }

          public function suscripcionNewsletter(){
            $query = $this->db->get('newsletter');
            return $query;
          }

          // inserta el codigo en la db
          public function insertaCodigoGenerado($codigo){
            $data = array('codigo' => $codigo);
            return $this->db->insert('encuestasM',$data);
          }
      }
?>
