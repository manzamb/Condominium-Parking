<?php
if ($this->session->userdata('autenticado')) {
    if ($this->session->userdata('autenticado') && $this->session->userdata('prorol') == "Directivo") {
        $this->load->view('includes/headerAutenticado');
    } else {

        $this->load->view('includes/headerAutenticadoUser');
    }
}
?>
<!-- Start content -->


<div class="container">
    <h1>Multas</h1>

    <label>Dirección de la casa: <input type="text" class="form-control" id="casdireccion" placeholder="Dirección de la casa" value="<?php echo $casdireccion; ?>" readonly="readonly"></label>

    <table id="tablaMultas"class="table tablet-striped table-bordered table-hover table-condense">
        <thead>
            <tr>
                <th>Identificador</th>
                <th>Dirección de casa</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <h2>CÁLCULO DE MULTAS</h2>
    <table id="tablaMultasCalculo"class="table tablet-striped table-bordered table-hover table-condense">
        <thead>
            <tr>
                <th>Direccion de casa</th>
                <th>Numero de multas calculadas</th>
                <th>Total</th>
            </tr>
        </thead>
    </table>

    <div class="about-text centered">
        <h3>Para la casa <?php echo $casdireccion; ?></h3>
        <p>Historial de multas obtenidas en su vivienda</p>
    </div>

</div>


<!-- End content -->
<?php $this->load->view('includes/footer'); ?>       