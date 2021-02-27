<?php


//Header que retorna el JSON
header("Content-Type: application/json");

//Header de Acces Control
header("Access-Control-Allow-Origin: *");

//Include
include('../../Class/Usuarios/Usuario_admin.php');

//Instancia
$_usarioadmin = new Usuario_admin();

//Switch(Desicion)
switch($_SERVER['REQUEST_METHOD']){


    case 'GET':

         $datos = json_decode(file_get_contents("php://input"),true);
       
         //Si recibimos el ID del usuario
        if(isset($array['Cod_conf']))
        {
             //Retorna la configuracion especificada por el ID
          $configuracion = $_usarioadmin->ObtenerConfigadmin($conn,$array);
        }
        else
        {
            //Retorna todas los configuraciones que se encuentren registrados
            $configuracion= $_usarioadmin-> ObtenerTodasConf($conn,$datos);
        }
        
        //Mostrar el contenido
         echo json_encode($configuracion);
            

        break;

       
    case 'PUT':
            //Recibiendo los Datos del JSON
            $postBody = file_get_contents("php://input");

            $datosArray = $_usarioadmin->ActualizarConfigVacantes($conn,$postBody);
      
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
        echo json_encode($resultado["mensaje"]);
        break;
          


}



?>