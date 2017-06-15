<style> h5 {
        text-align: right;
    } 
</style>
<h5> 
    <?php echo "      Usuario: ", $pronombre; ?>	
</h5>
<?php
if ($this->session->userdata('autenticado')) {
    if ($this->session->userdata('autenticado') && $this->session->userdata('prorol') == "Directivo") {
        $this->load->view('includes/headerAutenticado');
    } else {

        $this->load->view('includes/headerAutenticadoUser');
    }
}
?>
<body>
    <!-- Slider Start -->
    <section id="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-2">
                    <div class="block">
                        <h1 class="animated fadeInUp">Control de Parqueadero<br> </h1>
                        <p class="animated fadeInUp">Entrada y salida de vehiculos del conjunto residencial</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class ="container">
        <h2>ESTADO PARQUEADEROS</h2>
        <h3>Propietarios</h3>
        <table id="tablaEstacionamientos"class="table tablet-striped table-bordered table-hover table-condense">
            <thead>
                <tr>
                    <th>Casa</th>
                    <th>Estacionamiento</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <h3>Visitas</h3>
        <table id="tablaParqueadero"class="table tablet-striped table-bordered table-hover table-condense">
            <thead>
                <tr>
                    <th>Zona</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    <!-- Wrapper Start -->
    <section >
</body>

<?php $this->load->view('includes/footer'); ?>                                                          