<?php


//INCLUYENDO INTERFACE
include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Class/Includes/IEntidad.php');


class Paises{

    //Atributos
    private $ID_Pais;
    private $Codigo;
    private $Nombre;
    private static $Table = 'Paises';

    public function ObtenerPaises($conn,$datos)
    {
        $token = Token::validarToken($conn,$datos);
           
            if(is_bool($token))
            {
                $query = self::Query_Paises();
                $datos = $conn->Query($query);
                return $datos;
            }
            else
            {
                return $token;
            }
    }

    private static function Query_Paises()
        {
            $query = "SELECT ID_Pais, Codigo, Nombre FROM ".Paises::$Table;

             return $query;
        }


}

?>