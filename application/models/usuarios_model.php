<?php
class Usuarios_Model extends CI_Model {
  public function __construct()
  {
    $this->load->database();
  }

  public function get_usuarios()
  {
    $query = $this->db->get('usuarios');
    return $query->result_array();
  }

  public function get_usuarioById($id = FALSE)
  {
    if ($id === FALSE)
    {
      $query = $this->db->get('usuarios');
      return $query->result_array();
    }
    $query = $this->db->get_where('usuarios', array('id' => $id));
    return $query->row_array();
  }

  public function get_usuarioByEmail($email = FALSE)
  {
    if ($email === FALSE){
      return FALSE;
    }
    $query = $this->db->get_where('usuarios', array('email' => $email));
    return $query->row_array();
  }

  public function get_usuarioByCedula($cedula = FALSE)
  {
    if ($cedula === FALSE){
      return FALSE;
    }
    $query = $this->db->get_where('usuarios', array('cedula' => $cedula));
    return $query->row_array();
  }

  public function get_usuarioByTipo($tipoUsuario = FALSE)
  {
    if ($tipoUsuario === FALSE){
      return FALSE;
    }
    $query = $this->db->get_where('usuarios', array('tipoUsuario' => $tipoUsuario));
    return $query->row_array();
  }

  public function create_usuario($data)
  {
    $this->load->helper('url');/*
    $data = array(
      'nombre' => $this->input->post('nombre'),
      'email' => $this->input->post('email'),
      'tipoUsuario' => $this->input->post('tipoUsuario')
    );

    if ($this->input->post('cedula')){
      $data['cedula'] = $this->input->post('cedula');
    }

    if ($this->input->post('justificacion')){
      $data['justificacion'] = $this->input->post('justificacion');
    }*/
    return $this->db->insert('usuarios', $data);
  }

  public function update_usuario($id = FALSE)
  {
    if ($id === FALSE){
      return FALSE;
    }

    $this->load->helper('url');

    $data = array(
      'nombre' => $this->input->post('nombre'),
      'email' => $this->input->post('email'),
      'tipoUsuario' => $this->input->post('tipoUsuario')
    );
    if ($this->input->post('cedula')){
      $data['cedula'] = $this->input->post('cedula');
    }
    if ($this->input->post('justificacion')){
      $data['justificacion'] = $this->input->post('justificacion');
    }

    $this->db->where('id', $id);
    return $this->db->update('usuarios', $data);
  }


}
