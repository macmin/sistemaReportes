<!DOCTYPE html>
<html>
	<head>
		<title>Usuarios</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<script src="js/link.js"></script>
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
		<link rel="stylesheet" href="css/flexboxgrid.min.css">
	</head>
	<body>
		<header>
			<h1 class="encabezado">Usuarios</h1>
		</header>
		<center>
			<div class="contenedorUsuario">
				<i class="fa fa-user-circle fa-5x centrar" aria-hidden="true"></i>
				<div class="row around-xs center-xs">
            		<div class="col-xs-3">
						<input type="text" class="cajaTexto" placeholder="Nombre" id="txtNombre">
					</div>
					<div class="col-xs-3">
						<input type="text" class="cajaTexto" placeholder="Apellido Paterno" id="txtApp">
					</div>
					<div class="col-xs-3">
						<input type="text" class="cajaTexto" placeholder="Apellido Materno" id="txtApm">
					</div>
				</div>
				<div class="row around-xs middle-xs">		
					<div class="col-xs-4">
						<input type="text" class="cajaTexto" placeholder="Usuario" id="txtUsuario">
					</div>
					<div class="col-xs-4">
						<input type="password" class="cajaTexto" placeholder="Contraseña" id="txtPassword">
					</div>
					<div class="col-xs-4">
						<select class="selectRol">					
							<option disabled selected>Rol del Usuario</option>
							<option>Administrador</option>
							<option>Usuario</option>
						</select>
					</div>
				</div>
				<br>
				<br>
				<div class="row around-xs middle-xs">		
					<div class="col-xs-6">
						<button class="botonUsuarios" id="btnRegistrar">Registrar</button>
					</div>
					<div class="col-xs-6">
						<button class="botonUsuarios" type="button" onclick="javascript:opcionesusuarios();">Inicio</button>
					</div>
				</div>
			</div>
		</center>


			<script type="text/javascript">
				
				$(function(){

							$("#btnRegistrar").click(function(){
								
								var cajaNombre = $("#txtNombre").val();
				                var cajaApp = $("#txtApp").val();
				                var cajaApm=$("#txtApm").val();
				                var cajaUsuario = $("#txtUsuario").val();
				                var cajaPassword = $("#txtPassword").val();
				                var cajaRol = $("#selectRoles").val();

							    

							$.post('ws/wsUsuarios.php',
							{
								WS:"addUsuario",
								nombre:cajaNombre,
								app:cajaApp,
								apm:cajaApm,
								usuario:cajaUsuario,
								password:cajaPassword,
								rol:cajaRol

								

							},function(Respuesta){

								alert(Respuesta.Mensaje);
								if(Respuesta.codMensaje == 100)
									window.location =window.location;
								else if(Respuesta.codMensaje == 200)
									alert(Respuesta.Datos);
                                


								
							 },"json");
						
						    });
	            });



	            $(document).ready(function(){

											$.post('ws/wsUsuarios.php',{WS:"getRol"},function(Respuesta){
												
												var selectP=$("#selectRoles");

												if(Respuesta.Datos.length > 0){

													for(var i=0; i < Respuesta.Datos.length; i++){
														
														

														selectP.append("<option value="+Respuesta.Datos[i].rolId+">"+Respuesta.Datos[i].nombre+"</option>");
													
													}

												}
											});
										});
			</script>



	</body>
</html>