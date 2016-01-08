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
	          $this->db_encuesta = $this->load->database('encuesta', TRUE);
        }
        /**
        * function que revisara si existe el usuario y el password
        *
        *
        * @param $usuario
        * @param $password
        */
        public function login($usuario, $password){
            $this->db_encuesta->where('usuario',$usuario);
            $this->db_encuesta->where('password',$password);
            $this->db_encuesta->select('usuario, rol, id');
            $query = $this->db_encuesta->get('master');
            $row = $query->row_array();
            if(count($row) > 0){
              $data = array(
                'id' => $row['id'],
                'usuario' => $row['usuario'],
                'rol' => $row['rol']
              );
              return $data;
            }else{
              return false;
            }
        }
        //retorna toda la tabla para poder ver los que estan por aceptar no @params
        public function porAceptar(){
          $query = $this->db_encuesta->get('porValidar');
          return $query;
        }

        public function suscripcionNewsletter(){
          $query = $this->db_encuesta->get('newsletter');
          return $query;
        }

        // inserta el codigo en la db
        public function insertaCodigoGenerado($codigo){
          $data = array('codigo' => $codigo);
          return $this->db_encuesta->insert('encuestasM',$data);
        }
    }
?>
