<?php

include('IEntidad.php');

include('Conexion.php');

//Clase Usario admin herededa de Usuario
class Usuario_admin
{
    //Atributos 
    private $Tabla = "Configuracion";
    private $Numero_vacantes = "";
    protected $token = "";

    //Obtenertodas las config.
     public function ObtenerTodasConf()
     { 
         $conn = Conexion::getInstance();

        //Llamando la funcion privada Select_Categoria con la condicion del usuario solicitada
        $query = self::Select_Config();
        $datos = $conn->Query($query);

        //Retornar datos
        return $datos;
     }


     //Obtener Config especifica
     public static function ObtenerConfigadmin($json)
     {

         $conn = Conexion::getInstance();

        //ID de configuracion especifica   
        $conf_especifica = $json['Cod_conf'];

        //Llamando la funcion privada Select_Config con la condicion de  solicitada
        $query = self::Select_Config(). ' where Cod_conf = ' . $conf_especifica;
        $datos = $conn->Query($query);

        //Retornar datos
        return $datos;
     }
     
     //Select Basico Conf
      private static function Select_Config()
      {
              $query = " SELECT Cod_conf,Nombre,Numero_vacantes FROM Configuracion";  

              return $query;
      }

       //Funcion actualizar configuracion 
    public function ActualizarConfigVacantes($data)
    {
                //Comprobar campos requerido
                if( !isset($data['Numero_vacantes']))
                {      
                    //Campos requidos no enviados     
                    return Respuestas::error_400();
                }
                else
                {
                    $conn = Conexion::getInstance();

                    //Campos requidos enviados  
                    $this->Numero_vacantes        = $data['Numero_vacantes'];
                    
                    
                    // Llamar funcion Actualizar_Admon
                    $Actualizar_conf = $this->Actualizar_ConfAdmin($conn);
    
                    if( $Actualizar_conf >= 1)
                    {
                        

                        //Respuesta
                        
                        $respuesta = Respuestas::$response;
                        $respuesta['result'] = array(
                            "Cantidad_de_vacantes" => $this->Numero_vacantes
                            
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
                   
        //Funcion privada (Update Confif) 
        public function Actualizar_ConfAdmin($numero_vacante)
        {
            $conn = Conexion::getInstance();

            //Query
            $query = " update $this->Tabla
                        set Numero_vacantes = $numero_vacante
                        where Cod_conf =1  ";
                        
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

}



?>