<?php


//Header
header("Content-Type: application/json");

ini_set('display_errors',1); 
 error_reporting(E_ALL);

 include('../Class/Vacante.php');

 $_vacante = new Vacante();

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
        $array = json_decode(file_get_contents("php://input"),true);

        if(isset($array['ID_Vacante']))
        {
          $listaVacantes = $_vacante->Obtener($conn,$array);
        }
        elseif (isset($array['ID_Categoria']))
         {
          # code...
          $listaVacantes = $_vacante->Vacantes_Categoria($conn,$array);
        }
        else
        {
          $listaVacantes = $_vacante->ObtenerTodo($conn,$array);
        }
        
        echo json_encode($listaVacantes);

        break;
    
    case 'POST':

        $postBody = file_get_contents("php://input");
        $datosArray = $_vacante->Guardar($conn,$postBody);

        if (isset($datosArray["result"]["error_id"])) {
            // code...
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
          } else {
            // code...
            http_response_code(200);
          }

        echo json_encode($datosArray);

        break;


    case 'PUT':

      $postBody = file_get_contents("php://input");

      $datosArray = $_vacante->Actualizar($conn,$postBody);

      if (isset($datosArray["result"]["error_id"])) {
          // code...
          $responseCode = $datosArray["result"]["error_id"];
          http_response_code($responseCode);
        } else {
          // code...
          http_response_code(200);
        }

       echo json_encode($datosArray);
    

      break;   
         
         
    case 'DELETE':

      $postBody = file_get_contents("php://input");
      
      $datosArray = $_vacante->Eliminar($conn,$postBody);

      if (isset($datosArray["result"]["error_id"])) {
          // code...
          $responseCode = $datosArray["result"]["error_id"];
          http_response_code($responseCode);
        } else {
          // code...
          http_response_code(200);
        }

       echo json_encode($datosArray);

       break;


    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}




?>