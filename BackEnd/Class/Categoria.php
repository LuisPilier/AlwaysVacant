<?php

include('IEntidad.php');
include('Conexion.php');

class Categoria implements IEntidad{

        //Atributos
        private $ID_Categoria;

        public function Guardar($conn)
        {
            echo '';
        }

        public static function ObtenerTodo($conn)
        {
            echo '';
        }

        public static function Obtener($conn,$id)
        {
            echo '';
        }

        public function Actualizar($conn,$id)
        {
            echo '';
        }

        public static function Eliminar($conn,$id)
        {
            echo '';
        }


}


?>