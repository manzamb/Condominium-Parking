<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
 * A Design by GraphBerry
 * Author: GraphBerry
 * Author URL: http://graphberry.com
 * License: http://graphberry.com/pages/license
-->
<html lang="en">

    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Control de parqueo </title>


        <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <!--link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/pluton.css" />
        <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">


        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <!-- Data tables -->

        <script src ="http://localhost/parqueaderoRBD/js/jquery-1.10.2.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>




        <style>
            .modal-header, h4, .close{
                background-color: #252525;
                color:white !important;
                text-align: center;
                font-size: 30px;
            }
            .modal-footer {
                background-color: #D7DF01;
            }
        </style>  

    </head>
    <body>
        <div id="modales">
            <!--ventana para ingresar el numero de tarjeta RFI (temporal)-->   
            <div class="modal fade" id="vIngresar" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-plus"></span>Entrada nueva</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" id="fIngreso">
                                <div class="form-group">
                                    <label for="usrname"><span class="glyphicon glyphicon-barcode"></span> Numero de tarjeta</label>
                                    <input type="text" class="form-control" id="numeroTarjeta" placeholder="Numero de tarjeta">
                                </div>
                                <div class="form-group">                             
                                    <button type="button" class="btn btn-default" style="background:black" onclick="comprobar_entrada()"><span class="glyphicon glyphicon-plus"></span> Ingresar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-default pull-left" style="background:black" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

                        </div>
                    </div>

                </div>
            </div>
            <!-- ventana de ingreso de visitas-->
            <div class="modal fade" id="vVisitaNueva" tabindex="-1" role="dialog" aria-labelledby="titulo-modal5" aria-hidden="true">

                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <!--encabezado de la emergente-->
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" id="modalVisita"></h2>
                        </div>
                        <!--contenido de la emergente-->
                        <div class="modal-body" style="padding:40px 50px;">


                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombresVisitante" placeholder="Nombres visitante">
                            </div>
                            <div class="form-group">
                                <label for="">Casa visitada*</label>
                                <input type="text" class="form-control" id="casaVisitada" placeholder="bloque N casa 21">
                            </div>

                            <button type="button" id="btnEntarVisita" class="btn btn-primary" data-toggle='modal' onclick="entrar_visita()"><span class="glyphicon glyphicon-plus" ></span> Agregar visita</button>


                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-success"  data-dismiss="modal" id="btnSiguiemteNuevoProyeco"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>

                        </div>

                    </div>

                </div>
            </div>
            <!--ventana para ingresar el numero de tarjeta RFI (temporal-salida)-->   
            <div class="modal fade" id="vSalir" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-plus"></span>S A L I D A</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" id="fIngreso">
                                <div class="form-group">
                                    <label for="usrname"><span class="glyphicon glyphicon-barcode"></span> Numero de tarjeta</label>
                                    <input type="text" class="form-control" id="numeroTarjetaS" placeholder="Numero de tarjeta">
                                </div>
                                <div class="form-group">                             
                                    <button type="button" class="btn btn-default" style="background:black" onclick="comprobar_salida()"><span class="glyphicon glyphicon-plus"></span>Salir</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-default pull-left" style="background:black" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

                        </div>
                    </div>

                </div>
            </div>

            <!-- ventana modal multa-->
            <div class="modal fade" id="vReporte" tabindex="-1" role="dialog" aria-labelledby="titulo-modal5" aria-hidden="true">

                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <!--encabezado de la emergente-->

                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-plus"></span>R E P O R T E</h4>
                        </div>
                        <!--contenido de la emergente-->
                        <div class="modal-footer">
                            <table id="tablaReporte"class="table tablet-striped table-bordered table-hover table-condense">
                                <thead>
                                    <tr>
                                        <th>Total visitas</th>
                                        <th>Entradas totales</th>
                                        <th>Salidas totales</th>

                                    </tr>
                                </thead>
                            </table>
                            <button type="button"  class="btn btn-success"  data-dismiss="modal" id="btnSiguiemteNuevoProyeco" onclick="generar_reportes()" ><span class="glyphicon glyphicon-plus"></span>Aceptar</button>

                        </div>

                    </div>

                </div>
            </div>


            <!-- sesion -->

            <!-- Modal -->
            <div class="modal fade" id="sesion" tabindex="-1" role="dialog" aria-labelledby="titulo-modal5" aria-hidden="true">

                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <!--encabezado de la emergente-->
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" id="modalVisita"></h2>
                        </div>
                        <!--contenido de la emergente-->
                        <div class="modal-body" style="padding:40px 50px;">


                            <div class="form-group">
                                <label for="nombres">Cédula</label>
                                <input type="text" class="form-control" id="correo" placeholder="Cédula">
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="text" class="form-control" id="contrasena" placeholder="Contraseña">
                            </div>

                            <button type="button" id="btnEntarVisita" class="btn btn-primary" data-toggle='modal' onclick="iniciar_sesion()"><span class="glyphicon glyphicon-plus" ></span> Agregar visita</button>


                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-success"  data-dismiss="modal" id="btnSiguiemteNuevoProyeco"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>

                        </div>

                    </div>

                </div>
            </div>

            <!-- fin sesion -->


        </div>  
        
        
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="#" class="brand">
                        <img src="images/logo.png" width="120" height="40" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="#">Inicio</a></li>
                            <li><a href="#service">Servicios</a></li>
                            <li><a href="#multa">Multas</a></li>
                            <li><a href="#clients">Visitas</a></li>
                            <li><a href="#contact">Contactenos</a></li>
                            <li><a href="#sesion" data-toggle="modal" data-formato="Ingresar">Iniciar sesión</a></li>

                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        <!-- Start home section -->
        <div id="home">
            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <div class="triangle"></div>
                <!-- mask elemet use for masking background image -->
                <!--div class="mask"></div>
                <!-- All slides centred in container element -->
                <div class="container">
                    <div>
                        <button style="margin-top: 35px;" type="button" data-target="#vIngresar" class="btn btn-default " data-toggle="modal" data-formato="Ingresar">Ingresar</button>
                    </div>

                    <div>
                        <button style="margin-top: 35px;" type="button" data-target="#sesion" class="btn btn-default " data-toggle="modal" data-formato="Ingresar">Iniciar sesión</button>
                    </div>

                    <div id="box">
                        <div id="box-date"></div>
                        <div id="box-time"></div>
                    </div>

                    <div>
                        <button type="button" style="margin-top: 5px;" data-target="#vSalir" class="btn btn-default " data-toggle="modal" data-formato="Salir">Salir</button>
                    </div>
                    <!--iniciamos la table para simular parqueadero-->  
                    <div style="margin-top: 15px;">
                        <table id="tablaEstacionamientos" class="table tablet-striped table-bordered table-hover table-condense">
                            <thead>
                                <tr>
                                    <th>Casa</th>
                                    <th>Estacionamiento</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
                <!-- Start title section -->
                <div class="title">
                    <h1>Que Hacemos?</h1>
                    <!-- Section's title goes here -->
                    <p>Ofrecemos facilidad y confiabilidad a nuestros residentes en su zona de parqueo.</p>
                    <!--Simple description for section goes here. -->
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                                <img class="img-circle" src="images/Service1.png" alt="service 1">
                            </div>
                            <h3>Entrada y salida inteligente</h3>
                            <p>Tenemos un sistema moderno para gestionar las entradas y salidas de nuestro parqueadero.</p>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                                <img class="img-circle" src="images/Service2.png" alt="service 2" />
                            </div>
                            <h3>Multas por demoras en las visitas</h3>
                            <p>Para que todos usemos de la misma manera el parqueadero de las visitas.</p>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                                <img class="img-circle" src="images/Service3.png" alt="service 3">
                            </div>
                            <h3>Control al ingreso y a la salida</h3>
                            <p>Podemos saber en que momento sale o ingresa un automovila  nuesstro parqueadero.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service section end -->

        <!-- Reportes section start -->
        <div class="section secondary-section " id="reportes">
            <div class="triangle"></div>
            <div class="container">
                <div class=" title">
                    <h1>R E P O R T E S</h1>
                    <div>
                        <button style="margin-top: 35px;" type="button" data-target="#vReporte" class="btn btn-default " data-toggle="modal" data-formato="reporte">Reporte</button>
                    </div>
                    <p>Generar reportes para casa "c1"</p>
                </div>


            </div>
        </div>
    </div>
    <!-- Reportes section end -->



    <!-- Multas para el usuario -->
    <div class="section primary-section" id="multa">
        <div class="triangle"></div>
        <div class="container">
            <div class="title">
                <h1>Multas</h1>
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

            </div>

            <div class="about-text centered">
                <h3>Para la casa c1</h3>
                <p>Historial de multas obtenidas en su vivienda</p>
            </div>

        </div>
    </div>
    <!-- Multas section end -->


    <!-- Client section start -->
    <!-- Client section start -->
    <div id="clients">
        <div class="section primary-section">
            <div class="triangle"></div>
            <div class="container">
                <div class="title">
                    <h1>Parqueadero de visitas</h1>
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
        </div>
    </div>
    <!-- Contact section start -->
    <div id="contact" class="contact">
        <div class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>Contactenos</h1>
                    <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
                </div>
            </div>
            <div class="map-wrapper">
                <div class="map-canvas" id="map-canvas">Loading map...</div>
                <div class="container">
                    <div class="row-fluid">
                        <div class="span5 contact-form centered">
                            <h3>Say Hello</h3>
                            <div id="successSend" class="alert alert-success invisible">
                                <strong>Well done!</strong>Your message has been sent.</div>
                            <div id="errorSend" class="alert alert-error invisible">There was an error.</div>
                            <form id="contact-form" action="php/mail.php">
                                <div class="control-group">
                                    <div class="controls">
                                        <input class="span12" type="text" id="name" name="name" placeholder="* Your name..." />
                                        <div class="error left-align" id="err-name">Please enter name.</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <input class="span12" type="email" name="email" id="email" placeholder="* Your email..." />
                                        <div class="error left-align" id="err-email">Please enter valid email adress.</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <textarea class="span12" name="comment" id="comment" placeholder="* Comments..."></textarea>
                                        <div class="error left-align" id="err-comment">Please enter your comment.</div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button id="send-mail" class="message-btn">Send message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="span9 center contact-info">
                    <p>123 Fifth Avenue, 12th,Belgrade,SRB 11000</p>
                    <p class="info-mail">ourstudio@somemail.com</p>
                    <p>+11 234 567 890</p>
                    <p>+11 286 543 850</p>
                    <div class="title">
                        <h3>We Are Social</h3>
                    </div>
                </div>
                <div class="row-fluid centered">
                    <ul class="social">
                        <li>
                            <a href="">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-pinterest-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-dribbble-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-gplus-circled"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact section edn -->
    <!-- Footer section start -->
    <div class="footer">
        <p>&copy; 2013 Theme by <a href="http://www.graphberry.com">GraphBerry</a>, <a href="http://goo.gl/NM84K2">Documentation</a></p>
    </div>
    <!-- Footer section end -->
    <!-- ScrollUp button start -->
    <div class="scrollup">
        <a href="#">
            <i class="icon-up-open"></i>
        </a>
    </div>
    <!-- ScrollUp button end -->
    <!-- Include javascript -->

    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.mixitup.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/Concurrent.Thread.js"></script>
    <script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script type="text/javascript" src="js/jquery.bxslider.js"></script>
    <script type="text/javascript" src="js/jquery.cslider.js"></script>
    <script type="text/javascript" src="js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="js/jquery.inview.js"></script>
    <!-- Load google maps api and call initializeMap function defined in app.js -->
    <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script>
    <!-- css3-mediaqueries.js for IE8 or older -->
    <!--[if lt IE 9]>
        <script src="js/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/app.js"></script>

    <script type="text/javascript" src="http://localhost/parqueaderoRBD/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="http://localhost/parqueaderoRBD/js/dataTables.bootstrap.js"></script>





</body>





<script type=text/javascript>

                                    //Poner el reloj
                                    (function () {
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
                                                alert(data.estado);


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
                                                alert(data.estado);
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
                                        alert("entrar");
                                        var nombresVisitante = $('#nombresVisitante').val();
                                        var casaVisitar = $('#casaVisitada').val();
                                        var tarjeta = $('#numeroTarjeta').val();
                                        $.ajax({
                                            url: '<?php echo base_url('index.php/ingreso/ajax_entrar_visita'); ?>',
                                            data: {casa: casaVisitar},
                                            dataType: "JSON",
                                            success: function (data)
                                            {
                                                alert("aja");
                                                alert(data.estado);
                                                if (data.estado === false) {
                                                    alert("La casa no se encuentra registrada en el conjunto");
                                                    //se abre la puesrta pues la visita ya fue registrada

                                                } else {

                                                    if (data.estado == "L") {
                                                        registrarVisita();
                                                        $('#vVisitaNueva').modal('hide');
                                                        alert('Se abre la puerta, visita registrada.');
                                                    }
                                                    if (data.estado == "O") {
                                                        alert('El parqueadero de la casa ' + casaVisitar + " se encuentra ocupado");
                                                    }

                                                }
                                                tablaEstacionamientos.ajax.reload();
                                            }
                                        });
                                    }


                                    function registrarVisita() {
                                        alert("Registrando...");
                                        var nombresVisitante = $('#nombresVisitante').val();
                                        var casaVisitar = $('#casaVisitada').val();
                                        var tarjeta = $('#numeroTarjeta').val();
                                        $.ajax({
                                            url: '<?php echo base_url('index.php/ingreso/ajax_registrar_visita'); ?>',
                                            type: "POST",
                                            data: "visitante=" + nombresVisitante + "&casa=" + casaVisitar + "&tarjeta=" + tarjeta,
                                            dataType: "JSON",
                                            success: function (data)
                                            {

                                                alert(data.estado);
                                                if (data.estado === false) {
                                                    alert("ERROR Visita no registrada");
                                                } else {
                                                    alert("SUCCESS");
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

                                                alert(data.estado);
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
                                        alert("salir");
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
                                                        alert("Visita");
                                                    }
                                                    if (data.estado == "P")
                                                    {
                                                        salir_propietario();
                                                        alert("Propietario");
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
                                                alert(data.estado);
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
                                                alert(data.estado);
                                                if (data.estado === false) {
                                                    alert("Salida no válida para propietario");
                                                } else {
                                                    alert("Abre puerta para propietario");
                                                }
                                            }
                                        });
                                    }





                                    /*
                                     function proceso(parametro_texto) {
                                     while (true) {
                                     console.log(parametro_texto);
                                     await sleep(3000);
                                     console.log("three seconds later");
                                     await sleep(3000);
                                     setTimeout(function () {
                                     alert("SESIÓN EXPIRADA")
                                     }, 10000);
                                     }
                                     }
                                     Concurrent.Thread.create(proceso, "HOLA MUNDO");
                                     */

                                    function generar_reportes() {
                                        tablaReporte = $('#tablaReporte').DataTable({

                                            // Load data for the table's content from an Ajax source
                                            "ajax": {
                                                "retrieve": true,
                                                "processing": false, //Feature control the processing indicator.
                                                "serverSide": true,
                                                "searching": false,
                                                "method": "POST",
                                                "url": "<?php echo base_url('index.php/estacionamiento/ajax_generar_reportes'); ?>",

                                            },
                                            //Set column definition initialisation properties.
                                            "columns": [
                                                {"data": "Casa"},
                                                {"data": "Estacionamiento"}
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

                                                alert(data.estado);
                                                if(data.estado === false){
                                                    alert("La cédula "+correo+" no está registrada en el sistema");
                                                    location.href="http://www.pagina2.com";
                                                }
                                                else{
                                                    window.location.href = "http://localhost/parqueaderoRBD/index.php/administrador";
                                                }

                                            }
                                        });

                                    }






</script>
}
}

</html>
