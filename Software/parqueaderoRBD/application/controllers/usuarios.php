<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->model('usuario_model');
        $this->load->model('casaModel');
        $this->load->model('propietarioModel');
    }

    public function index() {
        /* if ($this->session->userdata('login')) {
          $this->load->view('welcome_message');

          }
          else{
          $this->load->view('offsesion');
          //$this->load->view('headers/librerias');
          } */
    }

    public function iniciar() {
        $proCedula = $this->input->post('username');
        $casDireccion = $this->casaModel->getDireccion($proCedula);
        $proContrasenia = $this->input->post('pwd');
        $contrasenia = $this->usuario_model->getContrasenia($proCedula);
        $proRol = $this->propietarioModel->getRol($proCedula);
        $proNombre = $this->propietarioModel->getNombre($proCedula);

        if ($contrasenia === FALSE) {
            echo json_encode(array("estado" => $contrasenia));
        } else {

            if ($proContrasenia == $contrasenia) {
                $dataUser = [
                    "username" => $proCedula,
                    "autenticado" => TRUE,
                    "casdireccion" => $casDireccion,
                    "prorol" => $proRol,
                    "pronombre" => $proNombre
                ];
                $this->session->set_userdata($dataUser);

                echo json_encode(array("estado" => "Usuario válido, inicio de sesión en progreso..."));
            } else {
                echo json_encode(array("estado" => "La contraseña no coincide"));
            }
        }
    }

    public function iniciar_sesion() {

        $email = $this->input->get('PostData');
        $data['usuario'] = $this->usuario_model->obtenerPorId($email);
        $dataP['proyecto'] = $this->proyecto->obtenerProyecto($email);
        $this->load->view('iniciado', $data + $dataP);
    }

    public function cerrar() {
        $this->session->sess_destroy();
    }

    //
    public function isLogin() {
        $login["login"] = $this->session->userdata('login');
        $login["username"] = $this->session->userdata('username');

        echo json_encode($login);
    }

    public function login() {

        if ($this->input->is_ajax_request()) {
            $username = $this->input->post("username");
            $pass = $this->input->post("pwd");

            $data = $this->usuario_model->getXId($username);
            //echo json_encode($data);
            if ($data == null) {
                echo json_encode(array("username" => "no"));
            } else {
                if ($data->username == $username) {
                    if ($data->pwd == sha1($pass)) {

                        $dataUser = [
                            "username" => $data->username,
                            "login" => TRUE
                        ];
                        $this->session->set_userdata($dataUser);
                        echo json_encode(array("username" => "si", "correcto" => "si"));
                        //$this->session->mark_as_flash('item');
                        //redirect('inventarioList');*/
                    } else {

                        echo json_encode(array("username" => "si", "correcto" => "no"));
                        // redirect('welcome');
                    }
                }
            }
        } else {
            
        }
    }

}
