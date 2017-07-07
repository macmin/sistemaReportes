<!DOCTYPE html>
<html>
    <head>
    	<title>.:: Prueba DataTable ::.</title>
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
    </head>
    <body>
        <header>
                <h1>Usuarios</h1>
        </header>
        <br>
        <br>
        <div>
        	<table id='tblRespuesta'>
        		<thead>
        			<tr>
        				<th>Usuario</th>
        				<th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
        				<th>Estatus</th>
                        <th>Acciones</th>
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
</html> q q