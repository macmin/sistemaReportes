<?php

include_once("../inc/connection.php");

class USUARIOS extends Connection
{

	public function __construct()
	{
        
	}

	public function consultaLogin($username, $pass)
	{

		$this -> setQuery("select nombre from users where username='mac@gmail.com' and password='7110eda4d09e062aa5e4a390b0a572ac0d2c0220'");
		$this -> Ejecutar();

		while($row = $this-> getResult() -> fetch_array() )
         
            $resultados[] = $row;
        return $resultados;  

    }

    






}