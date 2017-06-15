<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Space template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/responsive.css">
        <!--<link rel="stylesheet" href="css/dataTables.bootstrap.css')?>">-->

        <!-- Js -->
        <script src="<?php base_url('js/vendor/modernizr-2.6.2.min.js') ?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>');</script>
        <script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('js/owl.carousel.min.js') ?>"></script>
        <script src="<?php echo base_url('js/plugins.js') ?>"></script>
        <script src="<?php echo base_url('js/min/waypoints.min.js') ?>"></script>
        <script src="<?php echo base_url('js/jquery.counterup.js') ?>"></script>
        <script type="text/javascript" src="http://localhost/parqueaderoRBD/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="http://localhost/parqueaderoRBD/js/dataTables.bootstrap.js"></script>

        <!-- Google Map -->
        <!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
        <!--<script src="js/google-map-init.js"></script>-->


        <script src="<?php echo base_url('js/main.js') ?>"></script>


    </head>
    <body>



        <!-- Header Start -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- header Nav Start -->
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="index.html">
                                        <img src="<?php echo base_url(); ?>img/logo.png" alt="Logo">
                                    </a>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="index.html">Inicio</a></li>
                                        <li><a href="#vIngresar" data-toggle='modal' data-formato='Ingresar'>Entrar</a></li>
                                        <li><a href="#vSalir" data-toggle='modal' data-formato='Ingresar'>Salir</a></li>
                                        <li><a href="contact.html">Manual</a></li>
                                        <li><a href="#sesion" data-toggle='modal' data-formato='Ingresar'>Iniciar sesión</a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
            </div>
        </header><!-- header close -->



        <div id="modales">
            <!--ventana para ingresar el numero de tarjeta RFI (temporal)-->   
            <div class="modal fade" id="vIngresar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal5" aria-hidden="true">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span></span>Entrada nueva</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" id="fIngreso">
                                <div class="form-group">
                                    <label for="usrname"><span></span> Numero de tarjeta</label>
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
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span></span>Entrada nueva</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <div class="modal-body" style="padding:40px 50px;">


                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombresVisitante" placeholder="Nombres visitante">
                                </div>
                                <div class="form-group">
                                    <label for="">Casa visitada*</label>
                                    <input type="text" class="form-control" id="casaVisitada" placeholder="Casa n bloque m">
                                </div>
                                <div class="form-group">
                                    <label for="">Zona a parquear*</label>
                                    <input type="text" class="form-control" id="idParqueadero" placeholder="1">
                                </div>
                                <button type="button" id="btnEntarVisita" class="btn btn-primary" data-toggle='modal' onclick="entrar_visita()"><span class="glyphicon glyphicon-plus" ></span> Agregar visita</button>


                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-default pull-left" style="background:black" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

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
                            <h1 class="modal-title" id="modalVisita">Iniciar sesión</h1>
                        </div>
                        <!--contenido de la emergente-->
                        <div class="modal-body" style="padding:40px 50px;">


                            <div class="form-group">
                                <label for="nombres">Cédula</label>
                                <input type="text" class="form-control" id="correo" placeholder="Cédula" value="">
                            </div>
                            <div class="form-group">
                                <label for="contrasenia">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" placeholder="Contraseña" value="">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnEntarVisita" class="btn btn-primary" data-toggle='modal' onclick="iniciar_sesion()">Aceptar</button>

                        </div>

                    </div>

                </div>
            </div>

            <!-- fin sesion -->


        </div>
        <!-- Fin modales -->
