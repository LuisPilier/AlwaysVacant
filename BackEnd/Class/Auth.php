<?php

include('Includes/IEntidad.php');


Class Auth{

        //Atributos 
        private $User;
        private $Contrasena;

        public function login($conn,$json)
        {

            $datos = json_decode($json,true);
            if(!isset($datos['usuario']) || !isset($datos["password"])){
                //error con los campos
                return respuestas::error_400();
            }else{
                //todo esta bien 
                $usuario = $datos['usuario'];
                $password = $datos['password'];
                $password = $this->encriptar($password);
                $datos = $this->obtenerDatosUsuario($conn,$usuario);
                if($datos){
                    //verificar si la contraseña es igual
                        if($password == $datos[0]['Password']){
                                return $datos;
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
            $datos = $conn->NonQuery($query);
            if($datos){
                return $datos;
            }else{
                return 0;
            }
        }

        private function encriptar($string){
            return md5($string);
        }


}

?>