<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Models/Paises.php');

class PaisesController
{
    public static function ObtenerPaises()
    {
        $pais = new Paises();
        $datos = $pais->ObtenerPaises();
        return $datos;
    }
}

?>