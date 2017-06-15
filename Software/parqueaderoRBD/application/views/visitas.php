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
    <h1>VISITAS</h1>

    <label>Dirección de la casa: <?php echo $casdireccion; ?></label>

    <div class="title">
        <h1>Visitantes</h1>
        <p>Todos los visitantes que actualmente ingresaron en vehiculo a nuestro conjunto residencial.</p>
    </div>
    <div class="row">
        <div >
            <table id="tablaVisitas"class="table tablet-striped table-bordered table-hover table-condense">
                <thead>
                    <tr>
                        <th>Casa visitada</th>
                        <th>Visitante</th>
                        <th>Fecha de ingreso</th>
                        <th>Hora de ingreso</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- End content -->
<?php $this->load->view('includes/footer'); ?>       