<?php

//Incluyendo la interface
include('Includes/IEntidad.php');

//Clase categoria que implementa la interface
class Categoria implements IEntidad{

        //Atributos
        private $Tabla = "Categoria";
        private $ID_Categoria = "";
        private $Nombre = "";
        private $token ="";
        
         //METODOS
         
         
        //Funcion implementada de la Interface    
        public function Guardar($conn,$json)
        {
            // Array con datos
            $data = json_decode($json,true);

            //Metodo de la clase token, valida si fue enviado o si es valido
            $this->token = Token::validarToken($conn,$data);

            //Comprobar si el token existe 
            if(is_bool($this->token))
            {

                    
                    //Comprobar campos requeridos
                    if( !isset($data['Nombre']))
                    {      
                        //Campo requido no enviado     
                        return Respuestas::error_400();
                    }
                    else
                    {
                        //Campo requido enviado  y asignado a los atributos 
                        $this->Nombre         = $data['Nombre'];
                        
                        // Llamar funcion privada Insert_Categoria(Query de insertar categoria)
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
            else
            {
                     //Error en caso de que el token sea invalido o no sea enviado
                    return $this->token;
            }
        
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
        public static function ObtenerTodo($conn,$json)
        {
           //Validar token
          $token = Token::validarToken($conn,$json);
          

          if(is_bool($token))
          {
             //Ejecutar funcion privada Select_Categoria
            $query = self::Select_Categoria();
            $datos = $conn->Query($query);

            //Retornar datos
            return $datos;   
          }
          else
          {
               //Error en caso de que el token sea invalido o no sea enviado
              return  $token;
          }


        }

       //Funcion Implementada de la Interface (Obtener una categoria especificada por el ID_Categoria)
        public static function Obtener($conn,$json)
        {
            //Validar token
             $token = Token::validarToken($conn,$json);

             if(is_bool($token))
             {
                 //Extrayendo el ID_Categoria solicitado
                $ID_Categoria = $json['ID_Categoria'];
                
                //Llamando la function privada Select_Categoria con la condicion de la categoria solicitada
                $query = self::Select_Categoria(). ' WHERE ID_Categoria = ' .$ID_Categoria;
                $datos = $conn->Query($query);
                return $datos;
             }
             else
             {
                     //Error en caso de que el token sea invalido o no sea enviado
                    return  $token;

             }

        }

        //Funcion privada (Query general para el select de categoria) 
        private static function Select_Categoria()
        {
            
            //Query
            $query = "Select * from Categoria";
            return $query;
        }

 
        //Funcion Implementada de la Interface (Actualizar la categoria)
        public function Actualizar($conn,$json)
        {
                //Array con los datos
                $data = json_decode($json,true);

                //Validar token
                $this->token = Token::validarToken($conn,$data);

                if(is_bool($this->token))
                {


                        //Comprobar campos requerido
                        if( !isset($data['ID_Categoria']) ||  !isset($data['Nombre']))
                        {      
                            //Campos requidos no enviados     
                            return Respuestas::error_400();
                        }
                        else
                        {
                            //Campos requidos enviados  
                            $this->ID_Categoria         = $data['ID_Categoria'];
                            $this->Nombre               = $data['Nombre'];
                            
                            // Llamar funcion obtener(para verificar si el ID introducido existe)
                            $ID = self::Obtener($conn,$data);
            
                            if($ID)
                            {
                                //El ID introducido existe

                                //Llamando a la funcion privada Actualizar_Categoria(Update Categoria)
                                $resp = $this->Actualizar_Categoria($conn);
                                
                                $respuesta = Respuestas::$response;
                                $respuesta['result'] = array(
                                    "ID_Categoria" => $this->ID_Categoria,
                                    "Nombre"       => $this->Nombre
                                );
                                return $respuesta;
                
                                
                            }
                            else
                            {
                                    //Error al momento de buscar el ID introducido(no existe)
                                    return  Respuestas::error_500();
                        }  
                    }
                }
                else
                {
                        //Error en caso de que el token sea invalido o no sea enviado
                       return $this->token;
                }
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
        public function Eliminar($conn,$json)
        {
              // Array con datos
            $data = json_decode($json,true);

            
            //Validar token
            $this->token = Token::validarToken($conn,$data);


            if(is_bool($this->token))
            {

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
                    
                    // Llamar funcion obtener para ver si existe el ID solicitado
                    $ID = self::Obtener($conn,$data);

                    if($ID)
                    {       //Existe
                        
                            //Llamando a la funcion privada Delete Categoria (Eliminar una categoria)
                            $resp = $this->Delete_Categoria($conn);
                        
                            //Respuesta
                            $respuesta = Respuestas::$response;
                            $respuesta['result'] = array(
                                "ID_Categoria" => $this->ID_Categoria
                            );
                            return $respuesta;
                            
                    }
                    else
                    {
                        //Error al momento de eliminar
                        return  Respuestas::error_500();
                    }
                }
            }
            else
            {
                //Error en caso de que el token sea invalido o no sea enviado
                 return $this->token;
            }
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