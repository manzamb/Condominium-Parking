<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class RegistroModel extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function getIdRegistro() {
        $this->db->from('registro');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    
    function getDireccion($visid){
        $this->db->select('CASDIRECCION');
        $this->db->from('registro');
        $this->db->where('VISID', $visid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->CASDIRECCION;
        } else {
            return FALSE;
        }
    }
    
    function insertarRegistro($datos){
        $this->db->insert('registro', $datos);
        return $this->db->insert_id();
    }
    function estaActualmente($tarjeta){
        $this->db->from('registro');
        $this->db->where('VISID',$tarjeta);
        $query = $this->db->get();
 
        return $query->row();
    }

}