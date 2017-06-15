<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

    public function index() {
        if ($this->session->userdata('autenticado')) {
            $data["pronombre"] = $this->session->userdata('pronombre');

            if ($this->session->userdata('prorol') == "Directivo") {
                $this->load->view('directivo', $data);
            } else {
                if ($this->session->userdata('prorol') == "User") {
                    $this->load->view('usuario', $data);
                }
            }
        } else {
            $this->load->view('welcome_message');
        }
    }

}
