<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estacionamiento extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('casaModel');
        $this->load->model('visitaModel');
        $this->load->model('multaModel');
        $this->load->model('reporteModel');
        $this->load->model('parqueaderoModel');
    }

    public function ajax_listarEstacionamientos() {

        // listamos todos los estacionamientos de las casas con su respectivo estado ("libre","ocupado")
        $estacionamientos = $this->casaModel->listarCasas();
        $row = array();
        foreach ($estacionamientos as $estacionamiento) {
            $row[] = array(
                'Casa' => $estacionamiento['CASDIRECCION'],
                'Estacionamiento' => $estacionamiento['CASESTADO']
            );
        }
        $result = array("data" => $row);
        echo json_encode($result);
    }

    public function ajax_listarVisitas() {

        // listamos todos los estacionamientos de las casas con su respectivo estado ("libre","ocupado")
        $procedula = $this->session->userdata('username');
        $casdireccion = $this->session->userdata('casdireccion');;
        $visitas = $this->visitaModel->listarVisitas($casdireccion);
        $row = array();
        foreach ($visitas as $visita) {
            $row[] = array(
                'Casa visitada' => $visita['CASDIRECCION'],
                'Visitante' => $visita['VISNOMBRE'],
                'Fecha de ingreso' => $visita['VISFECHA'],
                'Hora de ingreso' => $visita['VISHORAINGRESO']
            );
        }
        $result = array("data" => $row);
        echo json_encode($result);
    }

    public function ajax_listar_multas() {

        $procedula = $this->session->userdata('username');
        $direccion = $this->casaModel->getDireccion($procedula);
        $multas = $this->multaModel->listarMultas($direccion);

        if ($multas === FALSE) {
            echo json_encode(FALSE);
        } else {
            $row = array();
            foreach ($multas as $multa) {
                $row[] = array(
                    'Identificador multa' => $multa['MULID'],
                    'Casa' => $multa['CASDIRECCION'],
                    'Precio de la multa' => $multa['MULVALOR'],
                    'Estado de la multa' => $multa['MULESTADO'],
                    'Fecha' => $multa['MULFECHA'],
                    'Hora' => $multa['MULHORA']
                );
            }
            $result = array("data" => $row);
            echo json_encode($result);
        }
    }

    public function ajax_calcular_multas() {
        $procedula = $this->session->userdata('username');
        $direccion = $this->casaModel->getDireccion($procedula);
        $multas = $this->multaModel->consultarMulta($direccion);
        $suma = $this->multaModel->sumaMultas($direccion);
        $total = $this->multaModel->totalMultas($direccion);

        if ($multas === FALSE) {
            echo json_encode(FALSE);
        } else {
            $row = array();
            $row[] = array(
                'Casa' => $direccion,
                'Total' => $total,
                'Numero' => $suma
            );
            $result = array("data" => $row);
            echo json_encode($result);
        }
    }

    public function ajax_generar_reportes() {

        $casdireccion = $this->session->userdata('casdireccion');
        $fecha = $this->input->post('fecha');
        $visitas = $this->reporteModel->totalVisitas($casdireccion,$fecha);
        $totalE = $this->reporteModel->totalEntradas($casdireccion,$fecha);
        $totalS = $this->reporteModel->totalSalidas($casdireccion,$fecha);

        if ($casdireccion === FALSE) {
            echo json_encode(FALSE);
        } else {
            $row = array();
            $row[] = array(
                'Casa' => $casdireccion,
                'Entradas' => $totalE,
                'Salidas' => $totalS,
                'Visitas' => $visitas
            );
            $result = array("data" => $row);
            echo json_encode($result);
        }
        //echo json_encode(array("estado" => $fecha));
    }
    
     public function ajax_listar_parqueadero() {
        $estacionamientos = $this->parqueaderoModel->listarParqueadero();
        $row = array();
        foreach ($estacionamientos as $estacionamiento) {
            $row[] = array(
                'Zona' => $estacionamiento['PARID'],
                'Estado' => $estacionamiento['PARESTADO']
            );
        }
        $result = array("data" => $row);
        echo json_encode($result);
    }
    
    
}
