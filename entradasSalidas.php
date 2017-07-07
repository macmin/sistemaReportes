<!DOCTYPE html>
<html>
	<head>
		<title>Entradas y Salidas</title>
		<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="js/mostrarOcultar.js"></script>
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css">
	</head>
	 <body>
        <header>
                <h1>Entradas y salidas</h1>
        </header>
        <br>
        <br>
        <div class="row around-xs center-xs">
                    <div class="col-xs-6">
                        <input type="text" class="cajaES alineacionTexto" name="" placeholder="EAN" autofocus="autofocus">
                        <input type="radio" name="registro" class="espaciado" onclick="mostrar()">Registro Manual
                        <input type="radio" name="registro" class="espaciado" onclick="ocultar()">Registro Automatico
                    </div>      
                    <div class="col-xs-6">      
                        Cantidad:
                        <input type="text" class="cajaES alineacionTexto" name="" placeholder="0">
                        <button class="botonES" id="registrar">Registrar</button>
                    </div>
                </div>
        <div>
        <br>
        <br>
        <br>
        <br>
        	<table id='tblRespuesta'>
        		<thead>
        			<tr>
        				<th>EAN</th>
        				<th>Nombre</th>
                        <th>Cantidad</th>
        			</tr>	
        		</thead>
        		<tbody>
        		</tbody>
        	</table>
        </div>
        <br>
        <br>
        <center>
            <button class="botonES">Guardar</button>
        </center>
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
                $.post("../WS/wsUsuarios.php",{WS:"getUsuario"},function(res){
                    table.rows().remove().draw();
                    $.each(res,function(index,data){
                        table.row.add([
                            data.userName,
                            data.nombre,
                            data.app,
                            data.apm,
                            data.statusId,
                            data.statusId == 1 ? "Activo" : "Inactivo"
                        ]);
                    });
                    table.rows().draw();
                });
        	});
        </script>
				
    </body>
</html> 