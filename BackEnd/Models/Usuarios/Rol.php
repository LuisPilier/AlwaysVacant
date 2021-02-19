<?php

include('../../Class/Includes/Conexion.php');



class Rol{

  //Atributos
    private $Tabla = "Rol";


  //Clases
  public function ObtenerRoles($conn)
  {
      $query = "select * from $this->Tabla";  
      $datos = $conn->Query($query);
      return $datos;


  }
  
  



}


?>