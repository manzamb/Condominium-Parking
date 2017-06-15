<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Direccionamiento extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('casaModel');
        $this->load->model('visitaModel');
        $this->load->model('multaModel');
    }

    public function multas() {
        if ($this->session->userdata('autenticado')) {
            $data["casdireccion"] = $this->session->userdata('casdireccion');
            $this->load->view('multas', $data);
        } else {
            $this->load->view('welcome_message');
        }
    }

    public function visitas() {
        if ($this->session->userdata('autenticado')) {
            $data["casdireccion"] = $this->session->userdata('casdireccion');
            $this->load->view('visitas', $data);
        } else {
            $this->load->view('welcome_message');
        }
    }

    public function reportes() {
        if ($this->session->userdata('autenticado') && $this->session->userdata('prorol') == "Directivo") {
            $data["casdireccion"] = $this->session->userdata('casdireccion');
            $this->load->view('reportes', $data);
        } else {
            if ($this->session->userdata('autenticado')) {
                $data["casdireccion"] = $this->session->userdata('casdireccion');
                $this->load->view('usuario', $data);
            } else {
                $this->load->view('welcome_message');
            }
        }
    }

    public function inicio() {
       if ($this->session->userdata('autenticado') && $this->session->userdata('prorol') == "Directivo") {
            $data["casdireccion"] = $this->session->userdata('casdireccion');
            $this->load->view('../directivo', $data);
        } else {
            if ($this->session->userdata('autenticado')) {
                $data["casdireccion"] = $this->session->userdata('casdireccion');
                $this->load->view('usuario', $data);
            } else {
                $this->load->view('welcome_message');
            }
        }
        
    }

}
