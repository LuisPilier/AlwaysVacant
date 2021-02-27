<?php

include('Conexion.php');

class Ciudades{

        //Atributos 
        private $ID_Ciudad;
        private $Codigo;
        private $Nombre;
        private $Codigo_pais;
        private static $Table = "Ciudades";

        public function ObtenerCiudades($datos)
        {
            $conn = Conexion::getInstance();
            $query = $this->Query_Ciudades($datos['Codigo_pais']);
            $datos = $conn->Query($query);
            return $datos;    
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