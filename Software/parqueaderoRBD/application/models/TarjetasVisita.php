<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TarjetasVisita extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function getVisita($tarjeta) {
        $this->db->from('tarjeta');
        $this->db->where('TARID', $tarjeta);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        } else {
            return FALSE;
        }
    }
    
    function getEstado($tarjeta) {
        $this->db->select('TARESTADO');
        $this->db->from('tarjeta');
        $this->db->where('TARID', $tarjeta);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->TARESTADO;
        } else {
            return FALSE;
        }
    }
    
    function setEstado($datosup,$id){
        $this->db->where('TARID', $id);
        $this->db->update('tarjeta', $datosup);
    }
    
    function getRol($tarjeta) {
        $this->db->select('TARROL');
        $this->db->from('tarjeta');
        $this->db->where('TARID', $tarjeta);

        $dataFinal = $this->db->get();

        $result = $dataFinal->row();
        //echo $result->tarrol;
        return $result->TARROL;
    }

}
