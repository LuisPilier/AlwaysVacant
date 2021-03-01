<?php

ini_set('display_errors', 1);

//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");


//Include
include('../../Controllers/Usuario_AdminController.php');

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){


    case 'GET':

         $datos = json_decode(file_get_contents("php://input"),true);
       
         //Si recibimos el ID del usuario
        if(isset($datos['Cod_conf']))
        {
             //Retorna la configuracion especificada por el ID
          $configuracion = Usuario_adminController::ObtenerConfigadmin($datos);
        }
        else
        {

            //Retorna todas los configuraciones que se encuentren registrados
            $configuracion= Usuario_adminController::ObtenerTodasConf($datos);
        }
        
        //Mostrar el contenido
         echo json_encode($configuracion);
            

        break;

       
    case 'PUT':
            //Recibiendo los Datos del JSON
            $datos = json_decode(file_get_contents("php://input"),true);
            
            $datosArray = Usuario_adminController::ActualizarConfigVacantes($datos);
      
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
               
               


       

    //Solicitud no encontrada  
    default:
         $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
         http_response_code(405);
         echo json_encode($resultado["mensaje"]);
         break;


}



?>