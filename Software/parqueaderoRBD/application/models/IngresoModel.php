<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class IngresoModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getUsuario() {
        $data = $this->db->get('Usuario');
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }

    function getUsuarioResult() {
        $consulta = $this->db->get('Usuario');
        return $consulta->result();
    }

    function setUsuario($data, $id_usuario = null) {

        if ($id_usuario == null) {
            $this->db->insert('Usuario', $data);
        } else {
            $this->db->where('EMAIL', $id_usuario);
            $this->db->update('Usuario', $data);
        }
    }

    function getUsuarios($id) {
        $data = array();
        $this->db->select('email,nombresusuario');
        $this->db->where('email', $id);
        $this->db->limit(1);
        $consulta = $this->db->get('Usuario');
        if ($consulta->num_rows() > 0) {
            $data = $consulta->row();
        }
        $consulta->free_result();
        return $data;
    }

    function deleteUsuario($id) {
        $this->db->where('email', $id);
        $this->db->limit(1);
        $this->db->delete('Usuario');
        return TRUE;
    }

    function searchUsuario($txtBuscar) {
        $this->db->like('nombresusuario', $txtBuscar);
        $txtBuscar = $this->db->get('usuario');
        if ($txtBuscar->num_rows() > 0) {
            return $txtBuscar;
        } else {
            return FALSE;
        }
    }

    /* function searchUsuario2($nombre){
      $this->db->like('nombre', $nombre,'both');
      return $this->db->get('usuario')->result();
      } */

    function mostrar($valor) {
        $this->db->like('nombresusuario', $valor);
        $consulta = $this->db->get('usuario');
        return $consulta->result();
    }

    function get_data($item, $match) {

        $this->db->like($item, $match);
        $query = $this->db->get('nombresusuario');

        return $query->result();
    }

}