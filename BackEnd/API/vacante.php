<?php


//Header
header("Content-Type: application/json");

ini_set('display_errors',1); 
error_reporting(E_ALL);

//Incluyendo la Clase Vacantes para utilizar sus metodos
include('../Class/Vacante.php');

 $_vacante = new Vacante();

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
        //Recibiendo los Datos del JSON
        $array = json_decode(file_get_contents("php://input"),true);

        //Si se recibe el ID de la vacante
        if(isset($array['ID_Vacante']))
        {
          //Retornar la Vacante especificada por el ID
          $listaVacantes = $_vacante->Obtener($conn,$array);
        }

      //Si se recibe el ID de la Categoria
        else if (isset($array['ID_Categoria']))
        {
            //Retornar las Vacantes por la Categoria especificada
          $listaVacantes = $_vacante->Vacantes_Categoria($conn,$array);
        }
        //Si no se especifican parametros
        else
        {
          //Retornar Todas las Categorias
          $listaVacantes = $_vacante->ObtenerTodo($conn,$array);
        }

        //Si Hay errores al retornar las vacantes
        if (isset($listaVacantes["result"]["error_id"])) 
        {
            // code...
            $responseCode = $listaVacantes["result"]["error_id"];
            http_response_code($responseCode);
        }
        else
        {
          http_response_code(200);
        }
       
        echo json_encode($listaVacantes);

        break;
    
    case 'POST':

        //Recibiendo los Datos del JSON
        $postBody = file_get_contents("php://input");
        $datosArray = $_vacante->Guardar($conn,$postBody);

        //Si Hay errores al Guardar, retornar el error
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

      //Recibiendo los Datos del JSON
      $postBody = file_get_contents("php://input");

      $datosArray = $_vacante->Actualizar($conn,$postBody);

      //Si hay errores al actualizar el registro especificado
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

      //Recibiendo los Datos del JSON
      $postBody = file_get_contents("php://input");
      
      $datosArray = $_vacante->Eliminar($conn,$postBody);

      //Si hay errores al eliminar registros
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
        http_response_code(405);
        echo json_encode($resultado["mensaje"]);
        break;
          


}




?>