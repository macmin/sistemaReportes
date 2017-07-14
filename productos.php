<?php

    session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Productos</title>
		<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    	<link rel="stylesheet" type="text/css" href="css/jquery.datatables.css" />
    	<link rel="stylesheet" type="text/css" href="css/buttons.datatables.css" />
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
    	<script type="text/javascript" src="DataTable/jquery.datatables.js"></script>
    	<script type="text/javascript" src="DataTable/dataTables.buttons.js"></script>
    	<script type="text/javascript" src="DataTable/buttons.flash.js"></script>
    	<script type="text/javascript" src="DataTable/jszip.js"></script>
    	<script type="text/javascript" src="DataTable/pdfmake.js"></script>
    	<script type="text/javascript" src="DataTable/vfs_fonts.js"></script>
    	<script type="text/javascript" src="DataTable/buttons.html5.js"></script>
    	<script type="text/javascript" src="DataTable/buttons.print.js"></script>
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
        <script src="js/link.js"></script>
        <script src="js/Loading.js"></script>
	</head>
	 <body>
        <header class="header">
            <div class="row around-xs center-xs">
                <div class="col-xs-4">
                    <h1 class="header__title">Productos</h1>
                </div>
                <div class="col-xs-4">
                    <nav class="header__nav">
                        <ul class="header__tabs">
                            <li class="header__tab">
                                <a class="header__link" href="opcionUsuario.php">Usuarios</a>
                            </li>
                            <li class="header__tab">
                                <a class="header__link" href="productos.php">Productos</a>
                            </li>
                            <li class="header__tab">
                                <a class="header__link" href="cargarArchivo.php">Archivo</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xs-4">
                    <i class="fa fa-user-circle fa-3x icono" style="color:white;" aria-hidden="true" onclick="document.getElementById('ventana1').style.visibility='visible'"></i>
                </div>     
            </div>
            <div class="ventana" id="ventana1">
                <span class="cerrar" onclick="document.getElementById('ventana1').style.visibility='hidden'">x
                </span>
                <center>
                    <br>
                    <form>
                        <a href="cerrar_session.php" class="linkFormato text-black">Salir</a>
                    </form>
                </center>
            </div>
        </header>
        <!--termina la navegacion-->
        <div class="marca-de-agua">
                <img src="css/fondo.jpg">
        </div>
        <br>
        <br>
        <div class="row around-xs center-xs">
            <div class="col-xs-4">
                <button class="botonProductos" onclick="javascript:addproductos();">Adicionar Producto</button>
            </div>      
            <div class="col-xs-4">      
                <button class="botonProductos" onclick="javascript:addEntrada();"> Adicionar Entrada</button>
            </div>
            <div class="col-xs-4">      
                <button class="botonProductos" onclick="javascript:addSalida();">Adicionar Salida</button>
            </div>

        </div>
        <br>
        <br>
        <br>
        <br>
        <div>
        	<table id='tblRespuesta'>
        		<thead>
        			<tr class="colortitulo">
        				<th>EAN</th>
        				<th>Nombre</th>
                        <th>Descripcion</th>
                        <th>CodigoAlterno</th>
                        <th>Cantidad</th>
                        
        			</tr>	
        		</thead>
        		<tbody>
        		</tbody>
        	</table>
        </div>
        <script type="text/javascript">
        	var table;
            
        	$(document).ready(function() {
                
        		table = $("#tblRespuesta").DataTable({
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
                $.Loading(true,"Cargando datos");
                $.post("ws/wsProductos.php",{WS:"getProductos"},function(res){
                    table.rows().remove().draw();
                    $.each(res.Datos,function(index,data){
                        table.row.add([
                            data.ean,
                            data.nombre,
                            data.descripcion,
                            data.codigoAlt,
                            data.numero


                            
                        ]);
                    },"json");
                    table.rows().draw();
                     $.Loading(false,"Cargando datos");
                });
        	});
           
        </script>

        <br>
        <br>
        <br>
        </div>
    </body>

<?php
 
    }else{
        echo "no hay sesion";
    }

?> 

</html> 