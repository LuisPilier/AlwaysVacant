<?php


//INCLUYENDO INTERFACE
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Ciudades.php');


class CiudadesController
{

    public static function ObtenerCiudades($datos)
    {
   
        if(!isset($datos['Codigo_pais']))
        {
            return respuestas::error_400();
        }
        else
        {
            $ciudad = new Ciudades();
            return $ciudad->ObtenerCiudades($datos);

        }
    }

}

?>