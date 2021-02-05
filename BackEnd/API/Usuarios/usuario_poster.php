<?php



//Header
header("Content-Type: application/json");

//Include
include('../Class/Usuario_poster.php');


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