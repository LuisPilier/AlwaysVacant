<?php

//Incluyendo la interface
include('IEntidad.php');

include('Conexion.php');


//Clase categoria que implementa la interface
class Categoria implements IEntidad{

        //Atributos
        private $Tabla = "Categoria";
        private $ID_Categoria = "";
        private $Nombre = "";
        private $token ="";
        
         //METODOS
         
         
        //Funcion implementada de la Interface    
        public function Guardar($datos)
        {
            $conn = Conexion::getInstance();

            //Campo requido enviado  y asignado a los atributos 
            $this->Nombre         = $datos['Nombre'];
            
            // Llamar funcion privada Insert_Categoria(Query de insertar categoria)
            $resp = $this->Insert_Categoria($conn);

            return $resp;
        }

        //Funcion privada (Query de insercion categoria)
        private function Insert_Categoria($conn)
        {
            
            //Query   
            $query = "Insert into $this->Tabla(Nombre) values ('$this->Nombre')";
            
            //Lamando la funcion que se encuentra en la clase conexion y que es utilizada por la interface
            $id = $conn->nonQueryId($query);
         

            if($id)
            {
                //Se inserto correctamente
               return $id;

            } 
            else
            {
                //Error al momento de insertar
                return 0;

            }

        }



         //Funcion Implementada de la Interface (Obtener todas las categoriass)
        public static function ObtenerTodo()
        {
            $conn = Conexion::getInstance();

             //Ejecutar funcion privada Select_Categoria
            $query = self::Select_Categoria();
            $datos = $conn->Query($query);

            //Retornar datos
            return $datos;   

        }

       //Funcion Implementada de la Interface (Obtener una categoria especificada por el ID_Categoria)
        public static function Obtener($datos)
        {
            $conn = Conexion::getInstance();

            //Extrayendo el ID_Categoria solicitado
            $ID_Categoria = $datos['ID_Categoria'];
            
            //Llamando la function privada Select_Categoria con la condicion de la categoria solicitada
            $query = self::Select_Categoria(). ' WHERE ID_Categoria = ' .$ID_Categoria;
            $datos = $conn->Query($query);
            return $datos;
        }

        //Funcion privada (Query general para el select de categoria) 
        private static function Select_Categoria()
        {
            
            //Query
            $query = "Select * from Categoria";
            return $query;
        }

 
        //Funcion Implementada de la Interface (Actualizar la categoria)
        public function Actualizar($datos)
        {
            $conn = Conexion::getInstance();

            //Campos requidos enviados  
            $this->ID_Categoria         = $datos['ID_Categoria'];
            $this->Nombre               = $datos['Nombre'];             

            //Llamando a la funcion privada Actualizar_Categoria(Update Categoria)
            $resp = $this->Actualizar_Categoria($conn); 
            
            return $resp;
        }  
        
    
           //Funcion privada (Update categoria) 
        private function Actualizar_Categoria($conn)
        {
               //Query
               $query = "UPDATE $this->Tabla SET Nombre = '$this->Nombre' where ID_Categoria = $this->ID_Categoria";
                           
               //Lamando la funcion que esta en la clase conexion y trae la interface
                $resp =  $conn->nonQuery($query);
    
                //Si se afectan las filas de la tabla categoria
                if($resp >= 1)
                {
                    return $resp;
                }
                else
                {
                    //Error
                    return 0;
                }
    
   
        }
   

    
           //Funcion Implementada de la Interface (Eliminar una categoria)
        public function Eliminar($datos)
        {
            $conn = Conexion::getInstance();

            //Campo requido enviado  
            $this->ID_Categoria = $datos['ID_Categoria'];         
                        
            //Llamando a la funcion privada Delete Categoria (Eliminar una categoria)
            $resp = $this->Delete_Categoria($conn);
        
            return $resp;           
                   
        }

          //Funcion privada (Delete categoria) 
        private function Delete_Categoria($conn)
        {
            //Query   
            $query = "DELETE FROM $this->Tabla where ID_Categoria = $this->ID_Categoria";
                        
             //Lamando la funcion que esta en la clase conexion y trae la interface
            $resp = $conn->nonQuery($query);
             
             //Si se afectan las filas de la tabla categoria
            if($resp >= 1)
            {
                return $resp;
            }
            else
            {
                //Error
                return 0;
            }

        }


        

    }



?>