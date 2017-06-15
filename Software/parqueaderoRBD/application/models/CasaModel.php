<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CasaModel extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function listarCasas() {
        $this->db->from('casa');
        $data = $this->db->get();
        return $data->result_array();
    }

    function consultarCedula($tarjeta) {
        $this->db->select('PROCEDULA');
        $this->db->from('propietario');
        $this->db->where('PRORFID', $tarjeta);

        $data = $this->db->get();


        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->cedula;
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
        $this->db->from('CASA');
        $this->db->where('VISID', $visId);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->CASDIRECCION;
        } else {
            return FALSE;
        }
    }

    function getEstado($casDireccion) {
        $casaRequest = $this->getCasa($casDireccion);
        if ($casaRequest == FALSE) {
            //echo "entra al false";
            return FALSE;
        } else {
            $this->db->select('CASESTADO');
            $this->db->from('casa');
            $this->db->where('CASDIRECCION', $casDireccion);
            $dataFinal = $this->db->get();

            $result = $dataFinal->row();
            //echo $result->estacionamiento;
            return $result->CASESTADO;
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

    function cambiarEstado($datosup, $direccion) {
        $this->db->where('CASDIRECCION', $direccion);
        $this->db->update('casa', $datosup);
    }

}
