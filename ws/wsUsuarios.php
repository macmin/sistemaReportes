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

                    $consulta = $this -> usuario -> consultaLogin($username, $pass);

                    $respuesta=[];

                    if($consulta){
                                
                                session_start();
                                $_SESSION["name"] = $username;
                                header("location:../menuAdministrador.php");


                    }else{
                            $respuesta = array("Mensaje" => "¡Error!, usuario no existe. ",
                                    "codMensaje" => 200,
                                    "Datos" => []
                                    );

                            echo json_encode($respuesta);
                        }   

                    }

                

                break;

            case 'getRol':

                $consulta = $this -> usuario -> getRolesExistentes();

            

                
            
                $respuesta=[];

                if($consulta){
                            $respuesta = array("Mensaje" => "Roles obtenidos",
                                                "codMensaje" => 100,
                                                "Datos" => $consulta
                                                );

                        echo json_encode($respuesta);
                        
                           


                }else{
                        $respuesta = array("Mensaje" => "¡Error!, no se encontraron los roles. ",
                                    "codMensaje" => 200,
                                    "Datos" => []
                                    );

                                 echo json_encode($respuesta);
                } 


                break;

            case 'addUsuario':

                $nombre = $this-> getPOST('nombre');
                $app = $this -> getPOST('app');
                $apm = $this-> getPOST('apm');
                $usuario = $this -> getPOST('usuario');
                $password = $this -> getPOST('password');
                $rol = $this -> getPOST('rol');
                $errors = array();

                if(empty ($nombre) )
                    $errors[] = "Falta el campo nombre";
                if(empty($apm) || empty($app) )
                    $errors[] = "Falta ingresar los apellidos";
                if(empty($usuario) || empty($password) ) 
                    $errors[] = "Usuario y password son requeridos";
                if(empty($rol) )
                    $errors[] = "Rol no seleccionado";

                if(count($errors) == 0 ){


                    $insert = $this -> usuario -> insertUsuario($usuario,$password,$nombre,$app,$apm,$rol);

                    if($insert){
                            $respuesta = array("Mensaje" => "Usuario registrado",
                                                "codMensaje" => 100,
                                                "Datos" => []
                                                );

                        echo json_encode($respuesta);
                        
                           


                    } else {
                            $respuesta = array("Mensaje" => "¡Error!, no se encontraron los roles. ",
                                    "codMensaje" => 200,
                                    "Datos" => []
                                    );

                                 echo json_encode($respuesta);
                    } 

                }

                if(isset($errors) and count($errors) > 0 ){

                    
                    $respuesta = array("Mensaje" => "Error",
                                    "codMensaje" => 200,
                                    "Datos" => $errors
                                    );
                        echo json_encode($respuesta);
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
