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

    public function getRolesExistentes()
    {
    	$this -> setQuery("select rolId,nombre from roles");
    	$this -> Ejecutar();

    	while($row = $this-> getResult() -> fetch_array() )
         
            $resultados[] = $row;
        return $resultados; 

    }

    public function insertUsuario($usuario,$password,$nombre,$app,$apm,$rol)
    {
    	$pass = sha1($password);
    	$this -> setQuery("insert into users(username,password,nombre,app,apm,rolId) values('$usuario','$pass','$nombre','$app','$apm',$rol) ");
    	$this ->Ejecutar();

    	return $this -> getIsCorrect();

    }






}