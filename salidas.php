<!DOCTYPE html>
<html>
	<head>
		<title>Salidas</title>
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
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
        <script src="js/link.js"></script>
	</head>
	 <body>
        <header>
                <h1>Salidas</h1>
        </header>
        <br>
        <br>
          <div class="row around-xs center-xs">
                    <div class="col-xs-6">

                        <input type="text" class="cajaES alineacionTexto" id="caja" placeholder="EAN" autofocus="autofocus" onkeypress="validar(event)">

                        <input type="radio" name="registro" class="espaciado" onclick="mostrar()">Registro Manual
                        <input type="radio" name="registro" class="espaciado" onclick="ocultar()">Registro Automatico
                    </div>      
                    <div class="col-xs-6">      
                        Cantidad:
                        <input type="text" class="cajaES alineacionTexto" id="txtCantidad" placeholder="0">
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
        				<th>Id</th>
        				<th>Nombre</th>
        				<th>Ean</th>
                        <th>Cantidad</th>
        			</tr>	
        		</thead>
        		<tbody>
        		</tbody>
        	</table>
        </div>
        <br>
        <br>
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
            });

                function validar(e) {
                   
                   console.log(e.keyCode);
                   var contador = 0;
                   tecla = (document.all) ? e.keyCode : e.which;
                   if (tecla==13)
                   {
                    alert('EAN: '+document.getElementById("caja").value );
                    var Ean = document.getElementById("caja").value;
                    var cajaCantidad = document.getElementById("txtCantidad").value;
                    $.post('ws/wsProductos.php',{
                                WS:"consultaEan",
                                ean:Ean,
                                cantidad:cajaCantidad
                                },function(Respuesta){

	                                    //table.rows().remove().draw();
	                                        $.each(Respuesta.Datos,function(index,data){
		                                         table.row.add([
		                                         	data.productoId,
		                                            data.ean,
		                                            data.nombre,
		                                            data.cantidad
		                                            
		                                        ]);

	                                        

		                                    });
		                                    table.rows().draw();    
	                                

                                },"");

                        document.getElementById("caja").value="";
                    } 
                }
                

            $(function(){
                $("#botonGuardar").click(function(){

                    var consulta = $("#tblRespuesta tbody tr");

                    $.each(consulta,function(index,tr){ 
                    	
                    	console.log(consulta);

                    	var cajaId = tr.children[0].textContent;
                        var cajaCantidad=tr.children[3].textContent;

                        alert(cajaCantidad);

                        $.post('ws/wsProductos.php',{
                                WS:"addMovimiento",
                                productoId:cajaId,
                                tipoM:4,
                                cantidad:cajaCantidad, 
                                user:1 
                            },function(Respuesta){},"");


                    });
                });
            });

            

        </script>

        <div class="row around-xs center-xs">
            <div class="col-xs-6">
                <button class="botonReporte" type="button" onclick="javascript:menuadministrador();">Regresar</button>
            </div>
            <div class="col-xs-6">
                <button class="botonReporte" type="button" id="botonGuardar" >Guardar</button>
            </div>
        </div>    



       
				
    </body>
</html> 