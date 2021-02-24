<?php


//INCLUYENDO INTERFACE
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Class/Includes/IEntidad.php');



class Ciudades{

//Atributos 
private $ID_Ciudad;
private $Codigo;
private $Nombre;
private $Codigo_pais;
private static $Table = "Ciudades";

public function ObtenerCiudades($conn,$datos)
{
    $token = Token::validarToken($conn,$datos);
           
    if(is_bool($token))
    {
        if(!isset($datos['Codigo_pais']))
        {
            return respuestas::error_400();
        }
        else
        {
            $query = $this->Query_Ciudades($datos['Codigo_pais']);
            $datos = $conn->Query($query);
            return $datos;
        }
    }
    else
    {
        return $token;
    }

}

private function Query_Ciudades($codigo_pais)
{
    $query = "
    SELECT c.ID_Ciudad, c.Codigo, c.Nombre, c.Codigo_pais, p.ID_Pais, p.Nombre Nombre_Pais  
    FROM ". Ciudades::$Table ." c
    INNER JOIN Paises p on p.Codigo = c.Codigo_pais WHERE c.Codigo_pais = '". $codigo_pais ."'";

    return $query;
}


}

?>