<?php



//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");


//Include
include('../Class/Usuarios/Usuario_user.php');


//Switch(Desicion)

switch([$_SERVER['REQUEST_METHOD']]){


    case 'GET':

        break;

    case 'POST':

       break;
       
    case 'PUT':

       break;   
               
               
    case 'DELETE':
      
       break;


       

    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}



?>