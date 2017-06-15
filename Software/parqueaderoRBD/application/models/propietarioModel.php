<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class propietarioModel extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }
    
    function getCedulaIdTar($tarId){
        $this->db->from('propietario');
        $this->db->where('TARID', $tarId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->PROCEDULA;
        } else {
            return FALSE;
        }
    }
    
    function getRol($proCedula){
        $this->db->select('PROROL');
        $this->db->from('propietario');
        $this->db->where('PROCEDULA', $proCedula);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->PROROL;
        } else {
            return FALSE;
        }
    }
    
    function getNombre($proCedula){
        $this->db->from('propietario');
        $this->db->where('PROCEDULA', $proCedula);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->PRONOMBRE;
        } else {
            return FALSE;
        }
    }
    
}
