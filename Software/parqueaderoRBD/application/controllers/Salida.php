<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salida extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('tarjetasVisita');
        $this->load->model('visitaModel');
        $this->load->model('registroModel');
        $this->load->model('casaModel');
        $this->load->model('propietarioModel');
        $this->load->model('parqueaderoModel');
    }

    //Comprobamos si la tarjeta está afuera o adentro del conjunto
    public function ajax_comprobar_salida() {
        date_default_timezone_set("America/Chicago");
        $idTarjeta = $this->input->get('tarjeta');
        $data = $this->tarjetasVisita->getEstado($idTarjeta);
        if ($data === FALSE) {
            echo json_encode(array("estado" => FALSE)); //No se encuentra registrada
        } else {
            echo json_encode(array("estado" => $data));
        }
    }

    public function ajax_tipo_salir() {
        date_default_timezone_set("America/Chicago");
        $idTarjeta = $this->input->get('tarjeta');
        $data = $this->tarjetasVisita->getVisita($idTarjeta);
        if ($data === FALSE) {
            echo json_encode(array("estado" => FALSE)); //No es visita
        } else {
            $tarRol = $this->tarjetasVisita->getRol($idTarjeta);

            if ($tarRol == "V") {
                echo json_encode(array("estado" => "V"));
            } else {
                echo json_encode(array("estado" => "P"));
            }
        }
    }

    public function ajax_salir_visita() {
        date_default_timezone_set("America/Chicago");
        $fecha = date("Y/m/d");
        $hora = date("H:i:s");
        $idTar = $this->input->get('tarjeta');
        $visId = $this->visitaModel->getVisitaMax($idTar);
        $casDireccion = $this->visitaModel->getDireccionVisId($visId);
        $idRegistro = $this->registroModel->getIdRegistro();
        $idRegistro = $idRegistro + 1;
        $parId = $this->visitaModel->getParId($visId);

        $datosup = array(
            'PARESTADO' => "Libre",
        );
        $this->parqueaderoModel->cambiarEstado($datosup, $parId);

        $datosReg = array(//Datos del registro
            'REGID' => $idRegistro,
            'CASDIRECCION' => $casDireccion,
            'REGFECHA' => $fecha,
            'REGHORA' => $hora,
            'REGESTADO' => "S"
        );
        $insertRegistro = $this->registroModel->insertarRegistro($datosReg);

        $dup = array(//Datos de la tarjeta
            'TARESTADO' => "F",
        );
        $this->tarjetasVisita->setEstado($dup, $idTar);

        $datos = array(//Datos de la visita
            'VISHORASALIDA' => $hora,
        );
        $this->visitaModel->setHoraSalida($datos, $visId);
        echo json_encode(array("estado" => $parId));
    }

    public function ajax_salir_propietario() {
        date_default_timezone_set("America/Chicago");
        $fecha = date("Y/m/d");
        $hora = date("H:i:s");
        $tarID = $tarj = $this->input->get('tarjeta');
        $proCedula = $this->propietarioModel->getCedulaIdTar($tarID);
        $casDireccion = $this->casaModel->getDireccion($proCedula);
        $idRegistro = $this->registroModel->getIdRegistro();
        $idRegistro = $idRegistro + 1;
        $datosup = array(
            'CASESTADO' => "L",
        );
        $this->casaModel->cambiarEstado($datosup, $casDireccion);

        $dup = array(
            'TARESTADO' => "F",
        );
        $this->tarjetasVisita->setEstado($dup, $tarID);

        $datosReg = array(
            'REGID' => $idRegistro,
            'CASDIRECCION' => $casDireccion,
            'REGFECHA' => $fecha,
            'REGHORA' => $hora,
            'REGESTADO' => "S"
        );
        $this->registroModel->insertarRegistro($datosReg);

        echo json_encode(array("estado" => TRUE));
    }

    public function calculaMulta() {
        //Agregamos a la tabla visitas y a la vez a la tabla ingreso.
        // De la tabla visitas se tomaran los valores para simular el parqueadero de visitas,
        //asi como para calcular las multas en caso de que asi se necesite
        date_default_timezone_set("America/Chicago");
        $fecha = date("Y/m/d");
        $hora = date("H:i:s");
        $datos = array(
            'idTarjeta' => $this->input->post('tarjeta'),
            'casaVisitada' => $this->input->post('casa'),
            'nombreVisitante' => $this->input->post('visitante'),
            'horaingreso' => $hora,
            'fechaIngreso' => $fecha,
            'horaSalida' => $this->input->post('proyecto')
        );

        $insert = $this->visitaModel->agregarVisita($datos);
        $datosReg = array(
            //'id'=>"",
            'direccion' => $this->input->post('casa'),
            'fecha' => $fecha,
            'horaSuceso' => $hora,
            'Propietario' => "NO",
            'tipo' => "entrada"
        );
        $insertRegistro = $this->registroModel->insertarRegistro($datosReg);
        echo json_encode(array("status" => TRUE));
    }

}
