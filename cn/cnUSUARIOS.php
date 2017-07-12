<?php

include_once("../inc/connection.php");

class USUARIOS extends Connection
{

	public function __construct()
	{
        
	}

	public function consultaLogin($username, $pass)
	{
        $con = sha1($pass);
		$this -> setQuery("select nombre,userId,rolId,statusId  from users where username='$username' and password='$con'");
		$this -> Ejecutar();
        $resultados=[];
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

    public function getUsuarios()
    {
    	$this -> setQuery("select username, password,nombre,app,apm,statusId from users");
    	$this -> Ejecutar();

    	while($row = $this-> getResult() -> fetch_array() )
         
            $resultados[] = $row;
        return $resultados;


    }






}