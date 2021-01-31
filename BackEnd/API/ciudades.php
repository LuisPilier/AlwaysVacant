<?php


//Header
header("Content-Type: application/json");

//Include
include('../Class/Ciudades.php');


//Switch(Desicion)

switch([$_SERVER['REQUEST_METHOD']]){


    case 'GET':

        break;

    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}


?>