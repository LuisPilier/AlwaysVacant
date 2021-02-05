<?php

include('IEntidad.php');

class Categoria implements IEntidad{

        //Atributos
        private $tabla = "Categoria";
        private $ID_Categoria;
        private $Nombre = "";
        private $token;
        


        public function Guardar($conn,$json)
        {
        
            $data = json_decode($json,true);


            if( !isset($data['Nombre']))
            {
                   return Respuestas::error_400();
            }
            else
            {
                  $this->Nombre         = $data['Nombre'];

                $resp = $this->Insert_Categoria($conn);

                if($resp)
                {
                
                    $respuesta['result'] = array(
                        "ID_Categoria" => $resp
                    );
                    return $respuesta;
                }
                else
                {
                    Respuestas::error_500();
                }

            }
        
        }
        private function Insert_Categoria($conn)
        {
            
            
            $query = "Insert into Categoria(Nombre) values ('$this->Nombre')";
            
           
            $id = $conn->nonQueryId($query);
            if($id)
            {
               return $id;

            } 
            else
            {
                return 0;

            }

        }




        public static function ObtenerTodo($conn,$json)
        {
        
            

        }

        public static function Obtener($conn,$json)
        {
            echo '';
        }

        public function Actualizar($conn,$json)
        {
            echo '';
        }

        public static function Eliminar($conn,$json)
        {
            echo '';
        }


}


?>