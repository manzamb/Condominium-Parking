<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class parqueaderoModel extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function listarParqueadero() {
        $this->db->from('PARQUEADERO');
        $data = $this->db->get();
        return $data->result_array();
    }

    function getEstado($parId) {
        $this->db->select('PARESTADO');
        $this->db->from('PARQUEADERO');
        $this->db->where('PARID', $parId);
        $data = $this->db->get();
        
        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->PARESTADO;
        } else {
            return FALSE;
        }
    }

    function getCasa($casDireccion) {
        $this->db->from('casa');
        $this->db->where('CASDIRECCION', $casDireccion);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        } else {
            return FALSE;
        }
    }
    
    function getDireccionVisId($visId) {
        $this->db->from('casa');
        $this->db->where('VISID', $visId);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->CASDIRECCION;
        } else {
            return FALSE;
        }
    }


    function getVisId($casDireccion) {
        $this->db->from('casa');
        $this->db->where('CASDIRECCION', $casDireccion);

        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->VISID;
        } else {
            return FALSE;
        }
    }

    function consultarEstacionamiento($tarjeta) {
        $cedula = $this->consultarCedula($tarjeta);
        if ($cedula == FALSE) {
            //echo "entra al false";
            return FALSE;
        } else {
            $this->db->select('CASESTADO');
            $this->db->from('casa');
            $this->db->where('PROCEDULA', $cedula);
            $dataFinal = $this->db->get();

            $result = $dataFinal->row();
            //echo $result->estacionamiento;
            return $result->estacionamiento;
        }
    }

    function getDireccion($proCedula) {
        $this->db->select('CASDIRECCION');
        $this->db->from('casa');
        $this->db->where('PROCEDULA', $proCedula);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->CASDIRECCION;
        } else {
            return $data;
        }
    }
    
    function consultarDireccion($tarjeta) {
        $cedula = $this->consultarCedula($tarjeta);
        $this->db->select('CASDIRECCION');
        $this->db->from('casa');
        $this->db->where('PROCEDULA', $cedula);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->direccion;
        } else {
            return $data;
        }
    }

    function cambiarEstado($datosup, $parId) {
        $this->db->where('PARID', $parId);
        $this->db->update('PARQUEADERO', $datosup);
    }

}
