<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VisitaMOdel extends CI_Model {

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function getVisitaMax($tarID) {
        $this->db->select_max('VISID');
        $this->db->from('visitante');
        $this->db->where('TARID', $tarID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->VISID;
        } else {
            return FALSE;
        }
    }

    function agregarVisita($datos) {
        $this->db->insert('visitante', $datos);
        return $this->db->insert_id();
    }

    function getVisitante($visId) {
        $this->db->from('visitante');
        $this->db->where('VISID', $visId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->TARID;
        } else {
            return FALSE;
        }
    }

    function getParId($visId) {
        $this->db->from('visitante');
        $this->db->where('VISID', $visId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->PARID;
        } else {
            return FALSE;
        }
    }

    function getDireccionVisId($visId) {
        $this->db->from('VISITANTE');
        $this->db->where('VISID', $visId);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $result = $data->row();
            return $result->CASDIRECCION;
        } else {
            return FALSE;
        }
    }

    function getIdVisitante() {
        $this->db->from('visitante');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function setHoraSalida($datosup, $visId) {
        $this->db->where('VISID', $visId);
        $this->db->update('visitante', $datosup);
    }

    function estaActualmente($tarjeta) {
        $this->db->from('visitante');
        $this->db->where('VISID', $tarjeta);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->casaVisitada;
        } else {
            return FALSE;
        }
    }

    function eliminarVisita($tarjeta) {
        $this->db->where('VISID', $tarjeta);
        $this->db->delete('visitante');
    }

    function listarVisitas($casdireccion) {
        $this->db->from('visitante');
        $this->db->where('CASDIRECCION', $casdireccion);
        $data = $this->db->get();
        return $data->result_array();
    }

}
