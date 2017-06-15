<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Usuario_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function registrar($datos)
    {
        $this->db->insert('usuario', $datos);
        return $this->db->insert_id();
    }
    function getXId($id){
    
        //$this->db->from('usuarios');
        $this->db->where("username",$id);
        $query = $this->db->get("usuarios");
 
        return $query->row();
    }
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('usuario');
    }
    public function eliminar_integrante_id($id)
    {
        $this->db->where('EMAIL', $id);
        $this->db->delete('trabaja');
    }
    
    function getContrasenia($proCedula){
        $this->db->select('PROCONTRASENIA');
        $this->db->from('propietario');
        $this->db->where('PROCEDULA', $proCedula);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->PROCONTRASENIA;
        } else {
            return FALSE;
        }
    }
    
    function validarDatos($datos){
        
    }
}