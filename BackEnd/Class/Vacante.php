<?php

include('Includes/IEntidad.php');

class Vacante implements IEntidad
{
        //Atributos
        private $ID_Vacante;
        private $Compania;
        private $Logo;
        private $URL;
        private $Position;
        private $Descripcion;
        private $ID_Categoria;
        private $ID_Tipo_Vacante;
        private $ID_Ciudad; 

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