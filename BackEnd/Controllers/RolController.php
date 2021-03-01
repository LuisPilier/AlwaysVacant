<?php

//INCLUDES
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Rol.php');
include('TokenController.php');


class RolController
{

  //Clases
  public static function ObtenerRoles()
  {
      $conn = Conexion::getInstance();
      $_rol = new Rol();

      $datos = $_rol->ObtenerRoles();

      return $datos;
  }
  

}


?>