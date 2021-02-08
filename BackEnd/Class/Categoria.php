<?php

include('Includes/IEntidad.php');

class Categoria implements IEntidad{

        //Atributos
        private $Tabla = "Categoria";
        private $ID_Categoria = "";
        private $Nombre = "";
        private $token;
        

        //Funcion de la Interface    
        public function Guardar($conn,$json)
        {
            // Array con datos
            $data = json_decode($json,true);

             //Comprobar campos requeridos
            if( !isset($data['Nombre']))
            {      
                   //Campo requido no enviado     
                   return Respuestas::error_400();
            }
            else
            {
                //Campo requido enviado  
                  $this->Nombre         = $data['Nombre'];
                
                // Llamar funcion privada Insert_Categoria
                $resp = $this->Insert_Categoria($conn);

                if($resp)
                {
                     //Respuesta de insercion exitosa y ID insertado
                    $respuesta['result'] = array(
                        "ID_Categoria" => $resp
                    );
                    return $respuesta;
                }
                else
                {
                    //Error al momento de insertar
                    Respuestas::error_500();
                }

            }
        
        }

        //Funcion privada (Query de insercion)
        private function Insert_Categoria($conn)
        {
            
            //Query   
            $query = "Insert into $this->Tabla(Nombre) values ('$this->Nombre')";
            
            //Lamando la funcion que esta en la interface
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
        
          $query = self::Select_Categoria();
          $datos = $conn->Query($query);
          return $datos;   

        }

        public static function Obtener($conn,$json)
        {
            $ID_Categoria = $json['ID_Categoria'];
            $query = self::Select_Categoria(). ' WHERE ID_Categoria = ' .$ID_Categoria;
            $datos = $conn->Query($query);
            return $datos;

        }


        private static function Select_Categoria()
        {
        
            $query = "Select * from Categoria";
            return $query;
        }

        public function Actualizar($conn,$json)
        {
                 // Array con datos
                 $data = json_decode($json,true);

                 //Comprobar campos requeridos
                if( !isset($data['ID_Categoria']))
                {      
                       //Campo requido no enviado     
                       return Respuestas::error_400();
                }
                else
                {
                    //Campo requido enviado  
                      $this->ID_Categoria         = $data['ID_Categoria'];
                      $this->Nombre               = $data['Nombre'];
                    
                    // Llamar funcion privada Insert_Categoria
                    $ID = self::Obtener($conn,$data);
     
                    if($ID)
                    {
                         //EXISTE
                         $resp = $this->Actualizar_Categoria($conn);
                        
                          return "Registro actualizado";
          
                           
                    }
                    else
                    {
                        //Error al momento de insertar
                        return "El ID de la categoria introducida no esta registrado";
                   }  
               }
           }  
        
        private function Actualizar_Categoria($conn)
           {
               $query = "UPDATE $this->Tabla SET Nombre = '$this->Nombre' where ID_Categoria = $this->ID_Categoria";
                           
               //Lamando la funcion que esta en la interface
             
                $conn->nonQueryId($query);
            
              
   
           }
   

    
        public function Eliminar($conn,$json)
        {
                // Array con datos
            $data = json_decode($json,true);

            //Comprobar campos requeridos
           if( !isset($data['ID_Categoria']))
           {      
                  //Campo requido no enviado     
                  return Respuestas::error_400();
           }
           else
           {
               //Campo requido enviado  
                 $this->ID_Categoria         = $data['ID_Categoria'];
               
               // Llamar funcion privada Insert_Categoria
               $ID = self::Obtener($conn,$data);

               if($ID)
               {
                    //EXISTE
                     $this->Delete_Categoria($conn);
                   
                     return "Categoria Eliminada";
                      
               }
               else
               {
                   //Error al momento de insertar
                   return "El ID de la categoria introducida no esta registrado";
               }
        }
    }
        private function Delete_Categoria($conn)
        {
            //Query   
            $query = "DELETE FROM $this->Tabla where ID_Categoria = $this->ID_Categoria";
                        
            //Lamando la funcion que esta en la interface
             $conn->nonQueryId($query);

        }


        

    }



?>