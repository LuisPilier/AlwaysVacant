<?php

//INCLUDES
include('Respuestas.php');
include('../Models/Usuario.php');
include('../Models/Token.php');

Class Auth{

        //Atributos 
        private $User;
        private $Contrasena;

        public static function login($datos)
        {
            if(!isset($datos['Usuario']) || !isset($datos["Contrasena"])){
                //error con los campos
                return respuestas::error_400();
            }else{

                $conn = Conexion::getInstance();

                $_user = new Usuario();

                //todo esta bien 
                $usuario   = $datos['Usuario'];
                $password  = $datos['Contrasena'];
                $password  = $conn->encriptar($password);
                $user_info = $_user->obtenerDatosUsuario($usuario);
                
                if($user_info){

                    //verificar si la contraseña es igual
                        if($password == $user_info[0]['Contrasena']){

                            //Instancia de Token
                            $token = new Token();
                            
                            $verifica = $token->Guardar($user_info[0]['ID_Usuario']);

                            if ($verifica) {
                              // code...
                              $result = Respuestas::$response;
              
                              $result['result'] = array(
                                  "Token" => $verifica
                              );
              
                              return $result;

                            }
              
                        }else{
                            //la contraseña no es igual
                            return respuestas::error_200("El password es invalido");
                        }
                }else{
                    //no existe el usuario
                    return respuestas::error_200("El usuaro $usuario  no existe ");
                }
            }
        }

         

}

?>