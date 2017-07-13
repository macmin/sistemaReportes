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
        
        switch($this-> WS) {

           case 'sigIn':
                $errors = array();
                
                $username = htmlentities(addslashes($this -> getPOST('usuario') ) );
                $pass = htmlentities(addslashes($this -> getPOST('password') ) );
                
                if(empty($username) )
                    $errors[]= "Falta el campo username";
                if(empty($pass) )
                    $errors[] = "Falta el campo password";

                if(count($errors) == 0 ){

                    $consulta = $this -> usuario -> consultaLogin($username, $pass);

                

                    

                    if($consulta){
                                
                                session_start();

                                if( ($_SESSION["rolId"] = $consulta[0][2] ) == 1 and ($_SESSION["statusId"] = $consulta[0][3] ) ==1 ){
                                    $_SESSION["name"] = $consulta[0][0];
                                    $_SESSION["userId"] = $consulta[0][1];

                                        header("location:../menuAdministrador.php");
                                
                                }else if( $_SESSION["statusId"] = $consulta[0][3] == 0){
                                    $_SESSION['no_session'] = "Usuario invalido";
                                    json_encode($_SESSION['no_session']); 
                                    header("location:../login.php");
                                
                                

                                }else if(count($consulta) <0 ){
                                    $_SESSION['no_session'] = "Usuario invalido";
                                    json_encode($_SESSION['no_session']); 
                                    header("location:../login.php");
                                     
                                }        
                                      



                    }else{
                            session_start();
                            $_SESSION['no_session'] = "Usuario invalido";
                            json_encode($_SESSION['no_session']); 
                            header("location:../login.php");
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

                $nombre = htmlentities(addslashes($this-> getPOST('nombre') ) ) ;
                $app = htmlentities(addslashes( $this -> getPOST('app') ) );
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
                if(! filter_var($usuario, FILTER_VALIDATE_EMAIL))
                    $errors[] = "usuario no tiene formato de correo";
                if(empty($rol))
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
                                    "Datos" => $errors[0]
                                    );
                        echo json_encode($respuesta);
                }  



                break;

            case 'getUsuarios':

                $consultaUsers = $this -> usuario -> getUsuarios();

                if($consultaUsers){
                            $respuesta = array("Mensaje" => "Usuarios encontrados",
                                                "codMensaje" => 100,
                                                "Datos" => $consultaUsers
                                                );

                        echo json_encode($respuesta);
                        
                           


                } else {
                            $respuesta = array("Mensaje" => "¡Error!, no se encontraron los usuarios. ",
                                    "codMensaje" => 200,
                                    "Datos" => []
                                    );

                                 echo json_encode($respuesta);
                    
                } 



                break;

            case 'modUsuario':
                $userId = $this -> getPOST('userId');
                $status = $this -> getPOST('status');

                if($status == "Activo"){
                        $nuevoStatus =0;
                }else {
                        $nuevoStatus=1;
                }

                $modificacion = $this -> usuario -> modUsuario($userId,$nuevoStatus);

                if($modificacion){
                            $respuesta = array("Mensaje" => "Usuarios Modificado",
                                                "codMensaje" => 100,
                                                "Datos" => []
                                                );

                        echo json_encode($respuesta);
                        
                           


                } else {
                            $respuesta = array("Mensaje" => "¡Error!, no se puede dar de baja. ",
                                    "codMensaje" => 200,
                                    "Datos" => []
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
