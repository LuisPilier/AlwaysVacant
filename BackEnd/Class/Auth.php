<?php

include('Includes/IEntidad.php');


Class Auth{

//Atributos 
private $User;
private $Contrasena;

public function login($conn,$json){
      
    $_respustas = new respuestas;
    $datos = json_decode($json,true);
    if(!isset($datos['usuario']) || !isset($datos["password"])){
        //error con los campos
        return $_respustas->error_400();
    }else{
        //todo esta bien 
        $usuario = $datos['usuario'];
        $password = $datos['password'];
        $password = $this->encriptar($password);
        $datos = $this->obtenerDatosUsuario($conn,$usuario);
        if($datos){
            //verificar si la contraseña es igual
                if($password == $datos[0]['Password']){
                        echo '';
                }else{
                    //la contraseña no es igual
                    return $_respustas->error_200("El password es invalido");
                }
        }else{
            //no existe el usuario
            return $_respustas->error_200("El usuaro $usuario  no existe ");
        }
    }
}



private function obtenerDatosUsuario($conn,$correo){
    $query = "SELECT UsuarioId,Password FROM Usuario WHERE ID_Usuario = '$correo'";
    $datos = $conn->obtenerDatos($query);
    if(isset($datos[0]["UsuarioId"])){
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