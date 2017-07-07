<?php
	
	session_start();

   	if( isset( $_SESSION['name'] ) ){
	
	echo "la sesion es:".$_SESSION['name'];

	}else{
			echo "no hay session";

			
	}

	
?>