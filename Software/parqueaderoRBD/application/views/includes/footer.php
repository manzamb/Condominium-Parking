
<!-- footer Start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-manu">
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
                <p>Copyright &copy; Crafted by <a href="https://dcrazed.com/">Dcrazed</a>.</p>
            </div>
        </div>
    </div>
</footer>


<script type=text/javascript>
    //document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');
    //Poner el reloj
    /*(function () {
     function formatTime(n) {
     return (n < 10) ? "0" + n : n;
     }
     ;
     
     function checkTime() {
     var today = new Date(),
     day = ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"],
     month = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
     h = formatTime(today.getHours()),
     min = formatTime(today.getMinutes()),
     seg = formatTime(today.getSeconds()),
     hour = h,
     w = "a.m.";
     
     if (hour >= 12) {
     hour = formatTime(hour - 12);
     w = "p.m.";
     }
     ;
     
     if (hour == 0) {
     hour = 12;
     }
     ;
     
     document.getElementById("box-date").innerHTML = "<span>" + day[today.getDay()] + ", " + today.getDate() + " " + month[today.getMonth()] + " " + today.getFullYear() + "</span>";
     document.getElementById("box-time").innerHTML = "<span class='hm-time'>" + hour + ":" + min + "</span> <span class='s-time'>" + seg + "</span> <span class='f-time'>" + w + "</span>";
     
     var d = setTimeout(function () {
     checkTime()
     }, 500);
     }
     ;
     
     checkTime();
     })();
     */

    //Lógica de funciones

    $(document).ready(function () {
        tablaEstacionamientos = $('#tablaEstacionamientos').DataTable({

            // Load data for the table's content from an Ajax source
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_listarEstacionamientos'); ?>",

            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Casa"},
                {"data": "Estacionamiento"}
            ]
        });
        
        tablaParqueadero = $('#tablaParqueadero').DataTable({

            // Load data for the table's content from an Ajax source
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_listar_parqueadero'); ?>",

            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Zona"},
                {"data": "Estado"}
            ]
        });
        
        tablaDeVisitas = $('#tablaVisitas').DataTable({
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_listarVisitas'); ?>",
            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Casa visitada"},
                {"data": "Visitante"},
                {"data": "Fecha de ingreso"},
                {"data": "Hora de ingreso"}
            ]
        });

        tablaMultas = $('#tablaMultas').DataTable({
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_listar_multas'); ?>",
            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Identificador multa"},
                {"data": "Casa"},
                {"data": "Precio de la multa"},
                {"data": "Estado de la multa"},
                {"data": "Fecha"},
                {"data": "Hora"}
            ]
        });

        tablaMultasCalculo = $('#tablaMultasCalculo').DataTable({
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_calcular_multas'); ?>",
            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Casa"},
                {"data": "Total"},
                {"data": "Numero"}
            ]
        });

    });


    function comprobar_entrada() {
        var tarjeta = $('#numeroTarjeta').val();
        var casaVisitar = $('#casaVisitada').val();
        $.ajax({
            url: '<?php echo base_url('index.php/ingreso/ajax_comprobar_tarjeta'); ?>',
            data: {tarjeta: tarjeta, casa: casaVisitar},
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.estado);


                if (data.estado === false) {
                    alert("Tarjeta " + tarjeta + " no pertenece al conjunto");
                } else {
                    if (data.estado == "F") {
                        comprobar_tipo_entrada();
                    } else {
                        if (data.estado == "D") {
                            alert("La tarjeta ya está adentro");
                        }
                    }
                }
            }

        });
    }

    function comprobar_tipo_entrada() {
        var tarjeta = $('#numeroTarjeta').val();
        var casaVisitar = $('#casaVisitada').val();
        $.ajax({
            url: '<?php echo base_url('index.php/ingreso/ajax_comprobar_entrada'); ?>',
            data: {tarjeta: tarjeta, casa: casaVisitar},
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.estado);
                if (data.estado == "V") {
                    $('.modal-title').text('Datos de la visita');
                    $('#vVisitaNueva').modal('show');
                    $('#vIngresar').modal('hide');
                } else {
                    if (data.estado == "P") {
                        alert("Propietario entrando");
                        registrar_propietario();
                        $('#vIngresar').modal('hide');
                    }
                }
            }

        });
    }

    function entrar_visita() {
        var nombresVisitante = $('#nombresVisitante').val();
        var casaVisitar = $('#casaVisitada').val();
        var tarjeta = $('#numeroTarjeta').val();
        var idParqueadero = $('#idParqueadero').val();
        $.ajax({
            url: '<?php echo base_url('index.php/ingreso/ajax_entrar_visita'); ?>',
            data: {casa: casaVisitar,idPar:idParqueadero},
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.estado);
                if (data.estado === false) {
                    alert("La casa no se encuentra registrada en el conjunto");
                    //se abre la puesrta pues la visita ya fue registrada

                } else {

                    if (data.estado == "Libre") {
                        registrarVisita();
                        $('#vVisitaNueva').modal('hide');
                        alert('Se abre la puerta, visita registrada.');
                    }
                    if (data.estado == "Ocupado") {
                        alert('El parqueadero de visitas ZONA ' + idParqueadero + " se encuentra ocupado");
                    }

                }
                tablaEstacionamientos.ajax.reload();
            }
        });
    }


    function registrarVisita() {
        var nombresVisitante = $('#nombresVisitante').val();
        var casaVisitar = $('#casaVisitada').val();
        var tarjeta = $('#numeroTarjeta').val();
        var idParqueadero = $('#idParqueadero').val();
        $.ajax({
            url: '<?php echo base_url('index.php/ingreso/ajax_registrar_visita'); ?>',
            type: "POST",
            data: "visitante=" + nombresVisitante + "&casa=" + casaVisitar + "&tarjeta=" + tarjeta + "&idPar=" + idParqueadero,
            dataType: "JSON",
            success: function (data)
            {

                //alert(data.estado);
                if (data.estado === false) {
                    alert("ERROR Visita no registrada");
                } else {
                    alert("Entrada exitosa");
                    tablaDeVisitas.ajax.reload();
                }

            }
        });
    }

    function registrar_propietario() {
        alert("Registrando Propietario...");
        var casaVisitar = $('#casaVisitada').val();
        var tarjeta = $('#numeroTarjeta').val();
        $.ajax({
            url: '<?php echo base_url('index.php/ingreso/ajax_registrar_propietario'); ?>',
            type: "POST",
            data: "casa=" + casaVisitar + "&tarjeta=" + tarjeta,
            dataType: "JSON",
            success: function (data)
            {

                //alert(data.estado);
                if (data.estado === false) {
                    alert("ERROR propietario no registrado");
                } else {
                    alert("Propietario registrado");
                    tablaEstacionamientos.ajax.reload();
                }

            }
        });
    }

    function comprobar_salida() {
        var tarjeta = $('#numeroTarjetaS').val();
        $.ajax({
            url: '<?php echo base_url('index.php/salida/ajax_comprobar_salida'); ?>',
            data: {tarjeta: tarjeta},
            dataType: "JSON",
            success: function (data)
            {
                if (data.estado === false) {
                    alert("Tarjeta " + tarjeta + " no pertenece al conjunto");
                } else {

                    if (data.estado == "D") {
                        salir();
                        $('#vSalir').modal('hide');
                    } else {
                        alert("Esta tarjeta no se encuentra adentro");
                    }
                }
            }
        });
    }

    function salir() {
        var tarjeta = $('#numeroTarjetaS').val();
        $.ajax({
            url: '<?php echo base_url('index.php/salida/ajax_tipo_salir'); ?>',
            data: {tarjeta: tarjeta},
            dataType: "JSON",
            success: function (data)
            {
                if (data.estado == false) {
                    alert("ERROR CONSULTA");
                } else {
                    if (data.estado == "V")
                    {
                        salir_visita();
                        alert("Salida de Visita");
                    }
                    if (data.estado == "P")
                    {
                        salir_propietario();
                        alert("Salida de Propietario");
                    }

                }
                tablaDeVisitas.ajax.reload();
                tablaEstacionamientos.ajax.reload();
            }
        });
    }

    function salir_visita() {
        var tarjeta = $('#numeroTarjetaS').val();
        $.ajax({
            url: '<?php echo base_url('index.php/salida/ajax_salir_visita'); ?>',
            data: {tarjeta: tarjeta},
            dataType: "JSON",
            success: function (data)
            {
                alert("Salida exitosa");
            }
        });
    }

    function salir_propietario() {
        var tarjeta = $('#numeroTarjetaS').val();
        $.ajax({
            url: '<?php echo base_url('index.php/salida/ajax_salir_propietario'); ?>',
            data: {tarjeta: tarjeta},
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.estado);
                if (data.estado === false) {
                    alert("Salida no válida para propietario");
                } else {
                    alert("Abre puerta para propietario");
                }
            }
        });
    }


    function generar_reportes() {
    
        var fecha = $('#fecha').val();
        console.log(fecha);
        tablaReporte = $('#tablaReporte').DataTable({

            // Load data for the table's content from an Ajax source
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "data": {fecha: fecha},
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_generar_reportes'); ?>",

            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Casa"},
                {"data": "Entradas"},
                {"data": "Salidas"},
                {"data": "Visitas"}
            ]
        });
    }
    
    function generar_reportes_anio() {
    
        var fecha = $('#fechaAnio').val();
        console.log(fecha);
        tablaReporte = $('#tablaReporteAnio').DataTable({

            // Load data for the table's content from an Ajax source
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "data": {fecha: fecha},
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_generar_reportes'); ?>",

            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Casa"},
                {"data": "Entradas"},
                {"data": "Salidas"},
                {"data": "Visitas"}
            ]
        });
    }
    
    function generar_reportes_mes() {
    
        var fecha = $('#fechaMes').val();
        console.log(fecha);
        tablaReporte = $('#tablaReporteMes').DataTable({

            // Load data for the table's content from an Ajax source
            "ajax": {
                "retrieve": true,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true,
                "searching": false,
                "method": "POST",
                "data": {fecha: fecha},
                "url": "<?php echo base_url('index.php/estacionamiento/ajax_generar_reportes'); ?>",

            },
            //Set column definition initialisation properties.
            "columns": [
                {"data": "Casa"},
                {"data": "Entradas"},
                {"data": "Salidas"},
                {"data": "Visitas"}
            ]
        });
    }

    function ingresar() {
        var correo = $('#correo').val();
        var pass = $('#contrasena').val();


        $.ajax({

            url: "http://localhost/parqueaderoRBD/index.php/usuarios/login",
            type: "POST",
            data: {username: correo, pwd: pass},
            dataType: "json",
            success: function (data) {
                if ((data.username == "si")) {

                    if (data.correcto == "si") {
                        console.log("datos correctos, lo dejamos ingresar");

                        window.location.href = "http://localhost/parqueaderoRBD/index.php/administrador";
                    } else {
                        console.log("contaseña incorrecta");
                    }
                } else {
                    console.log("correo incorrecto");
                }
            }
        });

    }


    function iniciar_sesion() {
        var correo = $('#correo').val();
        var pass = $('#contrasena').val();


        $.ajax({

            url: "http://localhost/parqueaderoRBD/index.php/usuarios/iniciar",
            type: "POST",
            data: {username: correo, pwd: pass},
            dataType: "json",
            success: function (data) {

                if (data.estado === false) {
                    alert("La cédula " + correo + " no está registrada en el sistema");
                } else {
                    window.location.href = "http://localhost/parqueaderoRBD/index.php/administrador";
                }

            }
        });

    }



    function cerrarSesion() {
        $.ajax({
            url: "http://localhost/parqueaderoRBD/index.php/usuarios/cerrar",
            type: "POST",
            data: {},

            success: function () {
                window.location.href = "http://localhost/parqueaderoRBD/";
            }
        });
    }




</script>            

</body>
</html>