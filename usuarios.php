<?php
	session_start();
    
    if( isset( $_SESSION['name'] ) and isset( $_SESSION['userId'] ) ) {

?>
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

	</head>
	<body>
		<header>
			<h1>Usuarios</h1>
		</header>
			<div class="contenedor">
				<center>
					<i class="fa fa-user-circle fa-5x centrar" aria-hidden="true"></i>
					<input type="text" class="cajaTexto" placeholder="Nombre" id="txtNombre">
					<input type="text" class="cajaTexto" placeholder="Apellido Paterno" id="txtApp">
					<input type="text" class="cajaTexto" placeholder="Apellido Materno" id="txtApm">
					<input type="text" class="cajaTexto" placeholder="Usuario" id="txtUsuario">
					<input type="password" class="cajaTexto" placeholder="Contraseña" id="txtPassword">
					<br>
					<select class="selectRol" id="selectRoles">
						<option disabled selected>Rol del Usuario</option>
						
					</select>
					<br>
					<br>
					<button class="boton" id="btnRegistrar">Registrar</button>
					<br>
					<br>
					<br>
					<button class="boton" type="button" onclick="javascript:opcionesusuarios();">Inicio</button>
				</center>
			</div>


			<script type="text/javascript">
				



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




				$(function(){

							$("#btnRegistrar").click(function(){
								
								var cajaNombre = $("#txtNombre").val();
				                var cajaApp = $("#txtApp").val();
				                var cajaApm=$("#txtApm").val();
				                var cajaUsuario = $("#txtUsuario").val();
				                var cajaPassword = $("#txtPassword").val();
				                var cajaRol = $("#selectRoles").val();
                                alert(cajaRol);
							    

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
			</script>

 	<?php
 		}else{
 			echo "no hay sesion";
 		}
 	?>

	</body>
</html>