<?php

//Header
header("Content-Type: application/json");

 
/**/
//Incluyendo la Clase Vacantes para utilizar sus metodos
include('../Controllers/VacanteController.php');

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){

    case 'GET':
        //Recibiendo los Datos del JSON
        $datos = json_decode(file_get_contents("php://input"),true);

        //Si se recibe el ID de la vacante
        if(isset($datos['ID_Vacante']))
        {
          //Retornar la Vacante especificada por el ID
          $listaVacantes = VacanteController::Obtener($datos);
        }

      //Si se recibe el ID de la Categoria
        else if (isset($datos['ID_Categoria']))
        {
            //Retornar las Vacantes por la Categoria especificada
          $listaVacantes = VacanteController::Vacantes_Categoria($datos);
        }
        //Si no se especifican parametros
        else
        {

          //Retornar Todas las Categorias
          $listaVacantes = VacanteController::ObtenerTodo($datos);
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
        $postBody = json_decode(file_get_contents("php://input"),true);
        $datosArray = VacanteController::Guardar($postBody);

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
      $postBody = json_decode(file_get_contents("php://input"),true);

      $datosArray = VacanteController::Actualizar($postBody);

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
      $postBody = json_decode(file_get_contents("php://input"),true);
      
      $datosArray = VacanteController::Eliminar($postBody);

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