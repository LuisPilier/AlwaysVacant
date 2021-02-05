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
        private $Token;

        public function Guardar($conn)
        {
            echo '';
        }

        private function insertar_vacante($conn)
        {
            $query = "INSERT INTO ".$this->table. " (DNI,Nombre,Direccion,CodigoPostal,Telefono,Genero,FechaNacimiento,Correo,Imagen) VALUES('".$this->dni."','".$this->nombre."','".$this->direccion."','".$this->codigoPostal."', '".$this->telefono."','".$this->genero."','".$this->fechaNacimiento."', '".$this->correo."','".$this->imagen."')";
        
            $resp = $conn->nonQueryId($query);
    
            if($resp)
            {
                return $resp;
            }
            else
            {
                return 0;
            }
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