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
    <h1>R E P O R T E S</h1>
    <label>Seleccione la fecha:</label>

    <div>
        <input name="fecha" id="fechaAnio" value="<?php echo date("Y"); ?>">
    </div>

    <div class="btn">
        <button style="margin-top: 35px;" type="button" data-target="#vReporte" class="btn btn-default " data-toggle="modal" data-formato="reporte">Generar por año</button>
    </div>

    <div>
        <input type="month" name="fecha" id="fechaMes" >    
    </div>
    <div class="btn">
        <button style="margin-top: 35px;" type="button" data-target="#vReporte" class="btn btn-default " data-toggle="modal" data-formato="reporte">Generar por mes</button>
    </div>

    <div>
        <input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>">
    </div>

    <div class="btn">
        <button style="margin-top: 35px;" type="button" data-target="#vReporte" class="btn btn-default " data-toggle="modal" data-formato="reporte">Generar por fecha</button>
    </div>

    <p>Generar reportes para casa <?php echo $casdireccion ?></p>

</div>
<!-- End content -->
<?php $this->load->view('includes/footer'); ?>       