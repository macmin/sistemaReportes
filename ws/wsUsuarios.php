<?php

include_once("../cn/cnUSUARIOS.php");

class wsUsuarios
{
	protected $usuario;
	protected $WS;

	public function __construct()
	{ 
		
        header('Content-Type: application/json');
		$this-> usuario = new USUARIOS();
        $this-> WS = $this->getPOST("WS");
        
        switch ($this-> WS) {

           case 'sigIn':
                 $errors = array();
                
                $username = $this -> getPOST('usuario');
                $pass = $this -> getPOST('password');
                if(empty($username) )
                    $errors[]= "Falta el campo username";
                if(empty($pass) )
                    $errors[] = "Falta el campo password";

                if(count($errors) == 0 ){

                    header('Location: mipagina.php');

                }

                

                break;
           
        	case 'N0':

        		$res= array ("Mensaje" => "El webservice no puede estar vacio", "codMensaje" => 200);
        		echo json_encode($res);

        		break;
        	
        	default:

        		$res= array ("Mensaje" => "El webservice no existe", "codMensaje" => 200 );
        		echo json_encode($res);
        		break;
        }


	}

	public function getPOST($var)
	{
    	if(isset($_POST[$var]) )
       		return $_POST[$var];
    	else
    		return "N0";
    }

   



}

new wsUsuarios();

?>
