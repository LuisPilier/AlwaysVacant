<?php

include('Includes/IEntidad.php');


Class Auth{

        //Atributos 
        private $User;
        private $Contrasena;

        public function login($conn,$json)
        {

            $datos = json_decode($json,true);
            if(!isset($datos['Usuario']) || !isset($datos["Contrasena"])){
                //error con los campos
                return respuestas::error_400();
            }else{


                //todo esta bien 
                $usuario  = $datos['Usuario'];
                $password = $datos['Contrasena'];
                $password = $conn->encriptar($password);
                $user_info = $this->obtenerDatosUsuario($conn,$usuario);
                
                if($user_info){
                    //verificar si la contraseña es igual
                        if($password == $user_info[0]['Contrasena']){
                            
                            $verifica = Token::insertarToken($conn,$user_info[0]['ID_Usuario']);

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



          private function obtenerDatosUsuario($conn,$usuario){
            $query = "SELECT ID_Usuario,Nombre,Apellido,Usuario,Contrasena,ID_Rol,Correo FROM Usuario WHERE Usuario = '$usuario'";
            $datos = $conn->Query($query);
            if($datos){
                return $datos;
            }else{
                return 0;
            }
        }



}

?>