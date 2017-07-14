<?php

    session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>


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
        <div class="marca-de-agua">
            <img src="css/fondo.jpg">
        </div>

 
     <input type="hidden" id="hiddenId" value="<?php echo  $_SESSION['userId']?>">


        <header>
                <h1 class="encabezado">Salidas</h1>
        </header>
        <br>
        <br>
        <div class="row around-xs center-xs">
            <div class="col-xs-6">
                <button class="botonReporte" type="button" onclick="javascript:productos();">Regresar</button>
            </div>
        
            <div class="col-xs-6">
                
            </div>
        </div>    
        <br>
        <br>
        <div class="row around-xs center-xs">
                    <div class="col-xs-6">

                        <input type="text" class="cajaES alineacionTexto" id="caja" placeholder="EAN" autofocus="autofocus" onkeypress="validar(event)">
                    </div>      
                    <div class="col-xs-6">      
                        Cantidad:
                        <input type="text" class="cajaES alineacionTexto" id="txtCantidad" placeholder="1" onKeyPress="return soloNumeros(event)">
                        
                    </div>
                </div>
        <div>
        <br>
        <br>
        <br>
        <br>
        	<table id='tblRespuesta'>
        		<thead>
        			<tr class="colortitulo">
        				<th>Id</th>
                        <th>Ean</th>
        				<th>Nombre</th>
                        <th>Cantidad</th>
        			</tr>	
        		</thead>
        		<tbody>
        		</tbody>
        	</table>
            <br>
            <br>
            <div class="row around-xs center-xs">
                <div class="col-xs-6">
                    <button class="botonReporte" type="button" id="botonGuardar" >Guardar</button>
                </div>
            </div>
        </div>
        <br>
        <br>
        <script type="text/javascript">

            function soloNumeros(e){
               var key = window.Event ? e.which : e.keyCode 
                
                return ((key >= 48 && key <= 57) || (key==8)) 

      
            }


            $(document).ready(function(){

                $("#txtCantidad").change(function(){

                    
                    $("#caja").focus();

                });

            });

        	
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
                    
                    var Ean = document.getElementById("caja").value;
                    var cajaCantidad = document.getElementById("txtCantidad").value;
                    var consulta = $("#tblRespuesta tbody tr");

                    if(cajaCantidad == "" ){
                        cajaCantidad =1;
                    }else if(cajaCantidad != ""){
                        cajaCantidad = cajaCantidad;
                    }
                    
                    var c=0;
                    if(consulta.children().length>1)
                    {
                        $.each(consulta,function(index,tr){
                            console.log(tr);
                            if(tr.children[1].textContent == Ean){
                                tr.children[3].textContent = parseInt(tr.children[3].textContent)+cajaCantidad;
                                c++;
                                return;
                            }

                        });

                    }

                    if(c==0){
                            $.post('ws/wsProductos.php',{
                                WS:"consultaEan",
                                ean:Ean,
                                cantidad:cajaCantidad
                                },function(Respuesta){

                                        if(Respuesta.codMensaje==100){
                                            $.each(Respuesta.Datos,function(index,data){
                                                 table.row.add([
                                                    data.productoId,
                                                    data.ean,
                                                    data.nombre,
                                                    data.cantidad
                                                    
                                                ]);

                                            

                                            });
                                            table.rows().draw();    
                                        }else if(Respuesta.codMensaje ==200)
                                            alert(Respuesta.Mensaje);

                                },"");
                        }


                    
                   

                    document.getElementById("caja").value="";
                    } 
                }
                

            $(function(){
                $("#botonGuardar").click(function(){

                    var consulta = $("#tblRespuesta tbody tr");
                    var idUser = $("#hiddenId").val();

                    $.each(consulta,function(index,tr){ 
                    	
                    	console.log(consulta);

                    	var cajaId = tr.children[0].textContent;
                        var cajaCantidad=tr.children[3].textContent;

                        

                        $.post('ws/wsProductos.php',{
                                WS:"addMovimientoS",
                                productoId:cajaId,
                                tipoM:4,
                                cantidad:cajaCantidad, 
                                user:idUser 
                            },function(Respuesta){
                                alert(Respuesta.Mensaje);
                                if(Respuesta.codMensaje ==100)
                                    window.location =window.location;

                            },"");


                    });
                });
            });

            

        </script>

       


<?php
    }else{
        echo "no hay sesion";
    }


?>
      
				
    </body>
</html> 