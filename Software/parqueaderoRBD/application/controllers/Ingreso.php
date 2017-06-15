<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ingreso extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('tarjetasVisita');
        $this->load->model('visitaModel');
        $this->load->model('registroModel');
        $this->load->model('casaModel');
        $this->load->model('propietarioModel');
        $this->load->model('parqueaderoModel');
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function ajax_comprobar_tarjeta() { //Consultar si una IDTAR existe en la tabla TARJETA
        date_default_timezone_set("America/Chicago");
        $idTarjeta = $this->input->get('tarjeta');
        //En esta línea obtenemos una consulta para una idTarjeta en caso que sea visita recibimos TRUE
        $data = $this->tarjetasVisita->getEstado($idTarjeta);

        if ($data === FALSE) {
            echo json_encode(array("estado" => FALSE)); //No es visita
        } else {
            echo json_encode(array("estado" => $data));
        }
    }

    public function ajax_comprobar_entrada() {
        date_default_timezone_set("America/Chicago");
        // primera consulta en la tablas de ingresos por dia para saber la tarjeta (la tarjeta RFID)
        // ya fue usada para ingresar 1 auto
        $idTarjeta = $this->input->get('tarjeta');
        //En esta línea obtenemos una consulta para una idTarjeta en caso que sea visita recibimos TRUE
        $data = $this->tarjetasVisita->getVisita($idTarjeta);

        if ($data === FALSE) {
            echo json_encode(array("estado" => FALSE)); //No es visita
        } else {
            $tarRol = $this->tarjetasVisita->getRol($idTarjeta);
            //echo json_encode(array("estado" => $idTarjeta));

            if ($tarRol == "V") {
                echo json_encode(array("estado" => "V"));
            } else {
                echo json_encode(array("estado" => "P"));
            }
        }
    }

    public function ajax_entrar_visita() {
        $casDireccion = $this->input->get('casa');
        $parId = $this->input->get('idPar');
        $data = $this->casaModel->getCasa($casDireccion);
        $visId = $this->casaModel->getVisId($casDireccion);
        $dataVisitado = $this->visitaModel->getVisitante($visId);
        if ($data === FALSE) {
            echo json_encode(array("estado" => FALSE));
        } else {

            if ($dataVisitado === FALSE) {

                $estadoParqueo = $this->parqueaderoModel->getEstado($parId);
                if ($estadoParqueo === "Libre") {
                    echo json_encode(array("estado" => "Libre"));
                }
                if ($estadoParqueo === "Ocupado") {
                    echo json_encode(array("estado" => "Ocupado"));
                }
            }
        }
    }

    public function ajax_registrar_visita() {
        //Agregamos a la tabla visitas y a la vez a la tabla ingreso.
        // De la tabla visitas se tomaran los valores para simular el parqueadero de visitas,
        //asi como para calcular las multas en caso de que asi se necesite
        $idTar = $this->input->post('tarjeta');
        $fecha = date("Y/m/d");
        $hora = date("H:i:s");
        $idVisitante = $this->visitaModel->getIdVisitante();
        $idVisitante = $idVisitante + 1;
        $idRegistro = $this->registroModel->getIdRegistro();
        $idRegistro = $idRegistro + 1;
        $casDireccion = $this->input->post('casa');
        $parId = $this->input->post('idPar');
        $datos = array(
            'VISID' => $idVisitante,
            'TARID' => $idTar,
            'CASDIRECCION' => $casDireccion,
            'PARID' => $parId,
            'VISNOMBRE' => $this->input->post('visitante'),
            'VISHORAINGRESO' => $hora,
            'VISFECHA' => $fecha,
            'VISHORASALIDA' => $this->input->post('proyecto')
        );

        $insert = $this->visitaModel->agregarVisita($datos);

        //Por último cambiamos el estado de la tarjeta a dentro (D) y la casa 
        /*$datosup = array(
            'VISID' => $idVisitante,
            'CASESTADO' => "O",
        );*/
        
        $datosup = array(
            'PARESTADO' => "Ocupado",
        );

        $dup = array(
            'TARESTADO' => "D",
        );
        $this->tarjetasVisita->setEstado($dup, $idTar);

        $this->parqueaderoModel->cambiarEstado($datosup, $parId);
        $datosReg = array(
            'REGID' => $idRegistro,
            'CASDIRECCION' => $this->input->post('casa'),
            'REGFECHA' => $fecha,
            'REGHORA' => $hora,
            'REGESTADO' => "E"
        );
        $insertRegistro = $this->registroModel->insertarRegistro($datosReg);
        echo json_encode(array("estado" => $parId));
    }

    public function ajax_registrar_propietario() {
        //Agregamos a la tabla visitas y a la vez a la tabla ingreso.
        // De la tabla visitas se tomaran los valores para simular el parqueadero de visitas,
        //asi como para calcular las multas en caso de que asi se necesite
        date_default_timezone_set("America/Chicago");
        $fecha = date("Y/m/d");
        $hora = date("H:i:s");
        $tarID = $tarj = $this->input->post('tarjeta');
        $proCedula = $this->propietarioModel->getCedulaIdTar($tarID);
        $casDireccion = $this->casaModel->getDireccion($proCedula);
        $idVisitante = $this->visitaModel->getIdVisitante();
        $idVisitante = $idVisitante + 1;
        $idRegistro = $this->registroModel->getIdRegistro();
        $idRegistro = $idRegistro + 1;
        $datosup = array(
            'CASESTADO' => "O",
        );
        $this->casaModel->cambiarEstado($datosup, $casDireccion);
        $dup = array(
            'TARESTADO' => "D",
        );
        $this->tarjetasVisita->setEstado($dup, $tarID);

        $datosReg = array(
            'REGID' => $idRegistro,
            'CASDIRECCION' => $casDireccion,
            'REGFECHA' => $fecha,
            'REGHORA' => $hora,
            'REGESTADO' => "E"
        );
        $insertRegistro = $this->registroModel->insertarRegistro($datosReg);
        echo json_encode(array("estado" => True));
    }

}
