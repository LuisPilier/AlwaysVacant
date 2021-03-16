<?php

//Incluyendo la interface
include('IEntidad.php');

include('Conexion.php');


class Rol{

  //Atributos
    private $Tabla = "Rol";


  //Clases
  public function ObtenerRoles()
  {
      $conn = Conexion::getInstance();

      $query = "select * from $this->Tabla";  
      $datos = $conn->Query($query);
      return $datos;


  }
  
  



}


?>