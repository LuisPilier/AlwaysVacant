<?php

include('Conexion.php');


class Paises
{
    //Atributos
    private $ID_Pais;
    private $Codigo;
    private $Nombre;
    private static $Table = 'Paises';

    public function ObtenerPaises()
    {
        $conn = Conexion::getInstance();
        $query = self::Query_Paises();
        $datos = $conn->Query($query);
        return $datos;
    }

    private static function Query_Paises()
    {
            $query = "SELECT ID_Pais, Codigo, Nombre FROM ".Paises::$Table;
             return $query;
    }

}

?>