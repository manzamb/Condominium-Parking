<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class multaModel extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function consultarMulta($casDireccion) {
        $this->db->from('MULTA');
        $this->db->where('CASDIRECCION', $casDireccion);
        $this->db->where('MULESTADO', "PENDIENTE");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return FALSE;
        }
    }

    function sumaMultas($casDireccion){
        $this->db->select_sum("MULVALOR");
        $this->db->from('MULTA');
        $this->db->where('CASDIRECCION', $casDireccion);
        $this->db->where('MULESTADO', "PENDIENTE");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->MULVALOR;
        } else {
            return FALSE;
        }
    }
    
    function totalMultas($casDireccion){
        $this->db->select("MULID");
        $this->db->from('MULTA');
        $this->db->where('CASDIRECCION', $casDireccion);
        $this->db->where('MULESTADO', "PENDIENTE");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->num_rows();
            return $result;
        } else {
            return FALSE;
        }
    }
    
    function calcularMultas($casDireccion){
        $this->db->select('CASDIRECCION');
        $this->db->select_sum("MULVALOR");
        $this->db->select_count("MULID AS 'TOTAL'");
        $this->db->from('MULTA');
        $this->db->where('CASDIRECCION', $casDireccion);
        $this->db->where('MULESTADO', "PENDIENTE");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        } else {
            return FALSE;
        }
    }
    
    function listarMultas($casDireccion) {
        $this->db->from('multa');
        $this->db->where('CASDIRECCION', $casDireccion);
        $data = $this->db->get();
        return $data->result_array();
    }

}
