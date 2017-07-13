<?php
    session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>
<!DOCTYPE html>
<html>
    <head>
    	<title>.:: Modificar ::.</title>
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
        <script src="js/link.js"></script>
    </head>
    <body>
        <header>
                <h1 class="encabezado">Usuarios</h1>
        </header>
        <div class="marca-de-agua">
                <img src="css/fondo.jpg">
        </div>
        <br>
        <br>
        <div>
        	<table id='tblRespuesta'>
        		<thead>
        			<tr class="colortitulo">
        				<th>Usuario</th>
        				<th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
        				<th>Estatus</th>
                        <th></th>
                        

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
                $.post("ws/wsUsuarios.php",{WS:"getUsuarios"},function(res){
                    table.rows().remove().draw();
                    $.each(res.Datos,function(index,data){
                        table.row.add([
                            data.username,
                            data.nombre,
                            data.app,
                            data.apm,
                            data.statusId == 1 ?  "Activo" : "Inactivo",
                            //data.statusId == 1 ? "Activo" : "Inactivo"
                            data.statusId ==1 ? "<button type ='button' class='editar'>Dar de baja </button>" : "<button type ='button' class='editar'>Dar de alta </button>",
                            data.userId 
                            //data.statusId == 1 ?  "<button value=1>Dar baja</button>" : "Inactivo"
                            
                        ]);
                    });
                    table.rows().draw();
                });

                obterner_data("#tblRespuesta tbody",table);
        	});



            var obterner_data = function(tbody,table){
                $(tbody).on("click","button.editar",function(){
                    var data = table.row( $(this).parents("tr") ).data();
                    var idUsuario = data[6];
                    var cajaStatus = data [4];
                    alert(idUsuario);
                    console.log(data);

                    $.post("ws/wsUsuarios.php",{WS:"modUsuario",userId : idUsuario,status : cajaStatus},function(respuesta){
                        
                        alert(respuesta.Mensaje);
                        if(respuesta.codMensaje == 100){
                            window.location =window.location;
                        } 
                        
                    });




                })
            }
            

        </script>


        

        <br>
        <br>
        <center>
            <button class="botonRegresar" type="button" onclick="javascript:opcionesusuarios();">Regresar</button>
        </center>
    <?php
        }else{
            echo "No hay sesion";
        }
    ?>
    </body>
</html> 