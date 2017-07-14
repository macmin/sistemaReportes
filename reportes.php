<?php
    session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reportes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.datatables.css" />
        <link rel="stylesheet" type="text/css" href="css/buttons.datatables.css" />
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script type="text/javascript" src="DataTable/jquery.datatables.js"></script>
        <script type="text/javascript" src="DataTable/dataTables.buttons.js"></script>
        <script type="text/javascript" src="DataTable/buttons.flash.js"></script>
        <script type="text/javascript" src="DataTable/jszip.js"></script>
        <script type="text/javascript" src="DataTable/pdfmake.js"></script>
        <script type="text/javascript" src="DataTable/vfs_fonts.js"></script>
        <script type="text/javascript" src="DataTable/buttons.html5.js"></script>
        <script type="text/javascript" src="DataTable/buttons.print.js"></script>
        <link rel="stylesheet" href="css/flexboxgrid.min.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/mostrarOcultar.js"></script>
        <script src="js/link.js"></script>
        <script src="js/jquery-ui.min.js"></script>

    </head>
    <body>
        <header>
            <h1 class="encabezado">Reportes</h1>
        </header>
        <br>
        <br>
        <center>
            <h2 class="text-black">Generar reporte por :</h2>
        </center>
        <br>
        <br>
        <div class="row around-xs center-xs">
            <div class="col-xs-4">      
                <input type="radio" class="white-text" name="reporte" onclick="mostrarfecha()">Rango de Fechas
            </div>
            <div class="col-xs-4">
                 <input type="radio" class="white-text" name="reporte" onclick="mostrarproducto()">Producto
            </div>
            <div class="col-xs-4">
                <input type="radio" name="reporte" onclick="entradasalida()">Entradas/Salidas
             </div>
        </div>
        <br>
         <br>
         <br>
         <br>
         <div id="fecha">
        <center>
             <script>
            $( function() {
            $( "#datepicker" ).datepicker();
             } );
            $( function() {
            $( "#datepicker1" ).datepicker();
            } );
            </script>
            <input type="text" class="cajasReporte" id="datepicker" placeholder="Fecha Inicial">
            <input type="text" class="cajasReporte" id="datepicker1" placeholder="Fecha Final">
            <br>
            <br>
            <button class="botonReporte">Generar Reporte</button>
        </center>
                    <div>
                        <table id='tblFechas'>
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>EAN</th>
                                    <th>Cantidad</th>
                                    <th>Movimiento<th>
                                </tr>   
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                     <script type="text/javascript">
                        var table;
                        $(document).ready(function() {
                            table = $("#tblFechas").DataTable({
                                paging:false,
                                dom: 'Bfrtip',
                                buttons:[
                                    {
                                        extend:"excelHtml5",
                                        title:"Reporte Excel"
                                    },
                                    {
                                        extend:"pdfHtml5",
                                        title:"Reporte PDF"
                                    }
                                ]
                            });
                            
                        });
                     </script>
                     <br>
                     <br>
                     <center>
                        <button class="botonReporte"  onclick="javascript:menuadministrador();">Regresar</button>
                     </center>
                </div>

                <div id="productos">
                    <center>
                        <input type="text" class="cajasReporte" id="producto" placeholder="Nombre del Producto">
                        <br>
                        <br>
                        <button class="botonReporte">Generar Reporte</button>
                    </center>
                    <div>
                        <table id='tblProductos'>
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>EAN</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    <th>Movimiento<th>
                                </tr>   
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                     <script type="text/javascript">
                        var table;
                        $(document).ready(function() {
                            table = $("#tblProductos").DataTable({
                                paging:false,
                                dom: 'Bfrtip',
                                buttons:[
                                    {
                                        extend:"excelHtml5",
                                        title:"Reporte Excel"
                                    },
                                    {
                                        extend:"pdfHtml5",
                                        title:"Reporte PDF"
                                    }
                                ]
                            });
                            
                        });
                     </script>
                     <br>
                     <br>
                     <center>
                        <button class="botonReporte"  onclick="javascript:menuadministrador();">Regresar</button>
                     </center>
                </div>

                </div>

                <div id="entradasalida">
                    <center>
                        <input type="text" class="cajasReporte" placeholder="Entrada/Salida">
                        <br>
                        <br>
                        <button class="botonReporte">Generar Reporte</button>
                    </center>
                     <div>
                        <table id='tblMovimientos'>
                            <thead>
                                <tr>
                                    <th>Movimiento<th>
                                    <th>Producto</th>
                                    <th>EAN</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                    
                                </tr>   
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                     <script type="text/javascript">
                        var table;
                        $(document).ready(function() {
                            table = $("#tblMovimientos").DataTable({
                                paging:false,
                                dom: 'Bfrtip',
                                buttons:[
                                    {
                                        extend:"excelHtml5",
                                        title:"Reporte Excel"
                                    },
                                    {
                                        extend:"pdfHtml5",
                                        title:"Reporte PDF"
                                    }
                                ]
                            });
                            
                        });
                     </script>
                     <br>
                     <br>
                     <center>
                        <button class="botonReporte"  onclick="javascript:menuadministrador();">Regresar</button>
                     </center>
                </div>

            </div>

    <?php
        }else{
            echo "No hay sesion";
        }
    ?>
    </body>
</html>