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
        $this -> setQuery("insert into users(username,password,nombre,app,apm,dateInsert,rolId,statusId) values('$usuario','$pass','$nombre','$app','$apm',NOW(),$rol,1) ");
    	$this ->Ejecutar();

    	return $this ->getIsCorrect();

    }

    public function getUsuarios()
    {
    	$this -> setQuery("select username, password,nombre,app,apm,statusId,userId from users");
    	$this -> Ejecutar();

    	while($row = $this-> getResult() -> fetch_array() )
         
            $resultados[] = $row;
        return $resultados;


    }

    public function modUsuario($userId,$nuevoStatus)
    {
        if( $userId == 1 ){
            

            return false;
            exit;

        }
        $this -> setQuery("update users set statusId= $nuevoStatus where userId = $userId");
        $this -> Ejecutar();

        return $this -> getIsCorrect();
   
    }






}