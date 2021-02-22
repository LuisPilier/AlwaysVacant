<?php

//Header
header("Content-Type: application/json");

//Include
include('../../Class/Usuarios/Rol.php');

//Instancia
$_rol = new Rol();

//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD']){


    case 'GET':
      
        $lista_rol = $_rol->ObtenerRoles($conn);
        echo json_encode($lista_rol);
        break;


    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}




?>