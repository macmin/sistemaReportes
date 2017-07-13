<?php

    session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>


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
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
        <script src="js/link.js"></script>
	</head>
	 <body>
        <input type="hidden" id="hiddenId" value="<?php echo  $_SESSION['userId']?>">
        <header>
                 <h1 class="encabezado">Entradas</h1>
        </header>
        <br>
        <br>
        <div class="row around-xs center-xs">
            <div class="col-xs-6">
                <button class="botonReporte" type="button" onclick="javascript:productos();">Regresar</button>
            </div>
            <div class="col-xs-6">
                <button class="botonReporte" type="button" id="botonGuardar" >Guardar</button>
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
                        <input type="text" class="cajaES alineacionTexto" id="txtCantidad"  placeholder="0" onKeyPress="return soloNumeros(event)">
                        
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
                        <th>Ean</th>
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
        
        <div class="ventanaModal" id="ventana1Modal">
            <span class="cerrarModal" onclick="document.getElementById('ventana1Modal').style.visibility='hidden'">x
            </span>
            <center>
                <br>
                    <div class="contenedorProductosES">
                    <div class="row around-xs center-xs">
                        <div class="col-xs-6">
                            <h2>EAN:</h2>
                            <input type="text" class="cajaTexto" id="txtEan" required>
                        </div>
                        <div class="col-xs-6">
                            <h2>Codigo Alterno:</h2>
                            <input type="text" class="cajaTexto" id="txtcodAlt">
                        </div>
                    </div>
                    <div class="row around-xs center-xs">
                        <div class="col-xs-6">
                            <h2>Nombre:</h2> 
                            <input type="text" class="cajaTexto" id="txtNombre" >
                        </div>
                        <div class="col-xs-6">
                            <h2>Descripcion:</h2>
                            <input type="text" class="cajaTexto" id="txtDesc" >
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row around-xs center-xs">
                        <div class="col-xs-6">
                            
                        </div>
                        <div class="col-xs-6">
                            <button class="boton" id="btnRegistrar">Registrar</button>  
                        </div>
                    <div>

                </div>
            </center>
        </div>


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
                        
                        var consulta = $("#tblRespuesta tbody tr");
                        var cajaCantidad = document.getElementById("txtCantidad").value;
                        
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
                                    table.destroy();
                                    tr.children[3].textContent = parseInt(tr.children[3].textContent)+parseInt(cajaCantidad);
                                    c++;

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
                                            }else if(Respuesta.codMensaje ==200){
                                                

                                                //alert(Respuesta.Mensaje);
                                                ConfirmDemo();

                                            }

                                    },"");
                            }


                        



                    

                        document.getElementById("caja").value="";
                        document.getElementById("txtCantidad").value="";
                    } 
               
                }
                

            $(function(){
                $("#botonGuardar").click(function(){

                    var consulta = $("#tblRespuesta tbody tr");
                    var idUser = $("hiddenId").value;

                    $.each(consulta,function(index,tr){ 
                    	
                    	console.log(consulta);

                    	var cajaId = tr.children[0].textContent;
                        var cajaCantidad=tr.children[3].textContent;

                        

                        $.post('ws/wsProductos.php',{
                                WS:"addMovimiento",
                                productoId:cajaId,
                                tipoM:3,
                                cantidad:cajaCantidad, 
                                user:idUser 
                            },function(Respuesta){

                            	 alert(Respuesta.Mensaje);

                            },"");


                    });
                });
            });

        function ConfirmDemo() {
            
            var mensaje = confirm("El producto no esta registrado.¿Deseas agregarlo?");
            
            if (mensaje) {
                document.getElementById('ventana1Modal').style.visibility='visible'
            }
            
            //comentario
        } 


        $(function(){

            $("#btnRegistrar").click(function(){
                
                
                var cajaEan = $("#txtEan").val();
                var cajaNombre = $("#txtNombre").val();
                var cajaDescripcion = $("#txtDesc").val();
                var cajaCodAlt = $("#txtcodAlt").val();
                var cajaUserId = $("#hiddenId").val();

                
                $.post('ws/wsProductos.php',
                    {
                        WS:"addProducto",
                        ean: cajaEan,
                        nombre:cajaNombre,
                        descripcion: cajaDescripcion,
                        codAlt:cajaCodAlt,
                        userId:cajaUserId
                        


                    },function(Respuesta){

                        alert(Respuesta.Mensaje);
                        if(Respuesta.codMensaje == 100)
                            window.location =window.location;
                        else if(Respuesta.codMensaje==200)
                            alert(Respuesta.Datos);


                    },"json");

            });

        });

         

        </script>


<?php

    }else{
        echo "No hay sesion";
    }

?>
       
				
    </body>
</html> 