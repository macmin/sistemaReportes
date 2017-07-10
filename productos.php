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
	</head>
	 <body>
        <header>
                <h1>Productos</h1>
        </header>
        <br>
        <br>
        <div>
        	<table id='tblRespuesta'>
        		<thead>
        			<tr>
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

                $.post("ws/wsProductos.php",{WS:"getProductos"},function(res){
                    table.rows().remove().draw();
                    $.each(res.Datos,function(index,data){
                        table.row.add([
                            data.ean,
                            data.nombre,
                            data.descripcion,
                            data.codigoAlt,
                            data.cantidad
                            

                            
                        ]);
                    });
                    table.rows().draw();
                    
                });
        	});
        </script>

        <h2>Productos<h2>
				<div class="row around-xs center-xs">
    				<div class="col-xs-4">

						<button class="botonProductos" onclick="javascript:addproductos();">Productos</button>Agregar Producto</button>

					</div>		
					<div class="col-xs-4">		
						<button class="botonProductos" onclick="javascript:bajaproductos();">Dar de Baja Producto</button>
					</div>
					<div class="col-xs-4">		
						<button class="botonProductos" onclick="javascript:addMovimientos();">Agregar Movimiento</button>
					</div>
				</div>

                 <br>
                <br>
                <br>
                <center>
                     <button class="botonRegresar" type="button" onclick="javascript:menuadministrador();">Regresar</button>
                </center>

    </body>

<?php
    }else{
        echo "no hay sesion";
    }

?>

</html> 