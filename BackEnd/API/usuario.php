<?php

//Header
header("Content-Type: application/json");

//Include

include('../Class/Usuario.php');

$conn = new Conexion();

//Switch(Desicion)

switch($_SERVER['REQUEST_METHOD']){


    case 'GET':

        $Usuarios = Usuario::ObtenerTodo($conn);
        echo json_encode($Usuarios);

        break;

    case 'POST':

         $_POST = json_decode(file_get_contents('php://input'),true);

         $usuario = new Usuario($_POST['Nombre'],$_POST['Apellido'],$_POST['Usuario'],$_POST['Contrasena'],$_POST['ID_Rol'],$_POST['Correo']);
         $usuario->Guardar($conn);


        break;
    
    case 'PUT':

      break;   
         
         
    case 'DELETE':

        $id = $_GET['id'];

        $Usuarios = Usuario::Eliminar($conn,$id);
        echo json_encode($Usuarios);

       break;
    
    //Solicitud no encontrada  
    default:
        $resultado["mensaje"] = "Enviaste una solicitud incorrecta";
        echo json_encode($resultado["mensaje"]);
        break;
          


}

?>