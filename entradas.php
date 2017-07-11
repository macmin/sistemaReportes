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
        <header>
                <h1>Entradas</h1>
        </header>
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
                                            

                                            alert(Respuesta.Mensaje);

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

                    $.each(consulta,function(index,tr){ 
                    	
                    	console.log(consulta);

                    	var cajaId = tr.children[0].textContent;
                        var cajaCantidad=tr.children[3].textContent;

                        

                        $.post('ws/wsProductos.php',{
                                WS:"addMovimiento",
                                productoId:cajaId,
                                tipoM:3,
                                cantidad:cajaCantidad, 
                                user:1 
                            },function(Respuesta){

                            	alert(Respuesta.Mensaje);

                            },"");


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