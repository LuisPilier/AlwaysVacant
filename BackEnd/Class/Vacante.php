<?php

include('Includes/IEntidad.php');

class Vacante implements IEntidad
{
        //Atributos
        private $ID_Vacante;
        private $Compania;
        private $Logo;
        private $URL;
        private $Posicion;
        private $Descripcion;
        private $ID_Categoria;
        private $ID_Tipo_Vacante;
        private $ID_Ciudad; 
        private $Ubicacion;
        private $Token;
        private $Email;
        private static $Table = 'Vacante';

        public function Guardar($conn,$json)
        {
            $datos = json_decode($json,true);

            if(!isset($datos['Token']))
            {
               return Respuestas::error_401();
            }

            else
            {
                $arrayToken  = Token::buscarToken($conn,$datos['Token']);
                
                if($arrayToken)
                {
                    if(!isset($datos['Compania']) || !isset($datos['ID_Tipo_Vacante']) || !isset($datos['Posicion']) || !isset($datos['ID_Ciudad']) || !isset($datos['Ubicacion']) || !isset($datos['ID_Categoria']))
                    {
                        return respuestas::error_400();
                    }
                    else
                    {
                        $this->Compania        = $datos['Compania'];
                        $this->ID_Tipo_Vacante = $datos['ID_Tipo_Vacante'];
                        $this->Posicion        = $datos['Posicion'];
                        $this->ID_Ciudad       = $datos['ID_Ciudad'];
                        $this->Ubicacion       = $datos['Ubicacion'];
                        $this->ID_Categoria    = $datos['ID_Categoria'];
                        $this->Email           = isset($datos['Email']) ? $datos['Email'] : '';
                        $this->Logo            = isset($datos['Logo'])  ? $datos['Logo']  : '';
                        $this->URL             = isset($datos['URL'])   ? $datos['URL']   : '';

                        if(isset($datos['Logo']))
                        {
                            $resp = $this->procesarImagen($datos['Logo']);
                            $this->Logo = $resp;
                        }
                        
                        $resp = $this->insertar_vacante($conn);

                        if($resp)
                        {
                            $respuesta = respuestas::$response;
                            $respuesta['result'] = array(
                                "ID_Vacante" => $resp
                            );
                            return $respuesta;
                        }
                        else
                        {
                            //return respuestas::error_500();
                            return $resp;
                        }
                    }
                }    
                else{
                    return Respuestas::error_401("El Token que envio es invalido o ha caducado");
                }
            }

        }

        private function insertar_vacante($conn)
        {
            $insert_fields = array(
             'Compania'        => "'$this->Compania'",
             'Logo' 	       => "'$this->Logo'",
             'URL'             => "'$this->URL'",
             'Posicion'        => "'$this->Posicion'",
             'Descripcion'     => "'$this->Descripcion'",
             'ID_Ciudad'       => "'$this->ID_Ciudad'",
             'ID_Categoria'    => "'$this->ID_Categoria'",
             'ID_Tipo_Vacante' => "'$this->ID_Tipo_Vacante'",
             'Email'           => "'$this->Email'",
             'Ubicacion'       => "'$this->Ubicacion'"
             );
    
            // Insert record
            $insert_sql = 'INSERT INTO ' . Vacante::$Table
                . ' ('   . implode(', ', array_keys($insert_fields))   . ')'
                . ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';
    
            $resp = $conn->nonQueryId($insert_sql);
    
            if($resp)
            {
                return $resp;
            }
            else
            {
                return 0;
                //return $insert_sql;
            }
        }

        private function procesarImagen($img)
        {
            $direccion = "../Images/";
            $partes    = explode(";base64,",$img);
            $extension = explode('/',mime_content_type($img))[1];
            $imagen_base64 = base64_decode($partes[1]);

            $nombre_foto = uniqid() . ".".$extension;

            $file = $direccion.''.$nombre_foto;
    
            file_put_contents($file,$imagen_base64);
    
            return $_SERVER['SERVER_NAME'].'/AlwaysVacant/BackEnd/Images/'.$nombre_foto;
    
        }

        public static function ObtenerTodo($conn,$array)
        {
            $query = self::Query_Vacante();
            $datos = $conn->Query($query);
            return $datos;
       
        }

        public static function Obtener($conn,$array)
        {
            $id = $array['ID_Vacante'];
            $query = self::Query_Vacante(). ' WHERE v.ID_Vacante = '.$id;
            $datos = $conn->Query($query);
            return $datos;
        }

        public static function Vacantes_Categoria($conn,$array)
        {
            $id = $array['ID_Categoria'];
            $query = self::Query_Vacante(). ' WHERE v.ID_Categoria = '.$id;
            $datos = $conn->Query($query);
            return $datos;
        }

        

        private static function Query_Vacante()
        {
            $query = "
            SELECT v.ID_Vacante,v.Compania ,v.Logo ,v.URL URL,v.Posicion Posicion,v.Descripcion,p.Codigo Codigo_Pais,
            p.Nombre, v.ID_Ciudad,ci.Nombre Ciudad,v.ID_Categoria,c.Nombre Categoria, v.ID_Tipo_Vacante,
            tv.Nombre TipoVacante,v.Email Email,v.Ubicacion Ubicacion
            FROM ".Vacante::$Table. " v
            INNER JOIN Tipo_Vacante tv on tv.ID_Tipo_Vacante = v.ID_Tipo_Vacante
            INNER JOIN Categoria c on c.ID_Categoria = v.ID_Categoria
            INNER JOIN Ciudades ci on ci.ID_Ciudad = v.ID_Ciudad
            INNER JOIN Paises p on ci.Codigo_pais = p.Codigo 
             ";

             return $query;
        }

        public function Actualizar($conn,$json)
        {
            $datos = json_decode($json,true);

            if(!isset($datos['ID_Vacante']) || !isset($datos['Compania']) || !isset($datos['ID_Tipo_Vacante']) || !isset($datos['Posicion']) || !isset($datos['ID_Ciudad']) || !isset($datos['Ubicacion']) || !isset($datos['ID_Categoria']))
            {
                return respuestas::error_400();
            }
            else{
                $this->ID_Vacante      = $datos['ID_Vacante'];
                $this->Compania        = $datos['Compania'];
                $this->ID_Tipo_Vacante = $datos['ID_Tipo_Vacante'];
                $this->Posicion        = $datos['Posicion'];
                $this->ID_Ciudad       = $datos['ID_Ciudad'];
                $this->Ubicacion       = $datos['Ubicacion'];
                $this->ID_Categoria    = $datos['ID_Categoria'];
                $this->Email           = isset($datos['Email']) ? $datos['Email'] : '';
                $this->Logo            = isset($datos['Logo'])  ? $datos['Logo']  : '';
                $this->URL             = isset($datos['URL'])   ? $datos['URL']   : '';
            }

            if(isset($datos['Logo']))
            {
                $resp = $this->procesarImagen($datos['Logo']);
                $this->Logo = $resp;
            }

            $resp =  $this->Query_Modificar_Vacante($conn);

            if($resp)
            {
                $respuesta = respuestas::$response;
                $respuesta['result'] = array(
                    "ID_Vacante" => $this->ID_Vacante
                );
                return $respuesta;
            }
            else{
                return respuestas::error_500();
            }

        }

        private function Query_Modificar_Vacante($conn)
        {
            $query = "UPDATE ".Vacante::$Table. " SET Compania = '".$this->Compania."',ID_Tipo_Vacante = '".$this->ID_Tipo_Vacante."',
            Posicion = '".$this->Posicion."',ID_Ciudad = '".$this->ID_Ciudad."',Ubicacion = '".$this->Ubicacion."',
            ID_Categoria = '".$this->ID_Categoria."',Email = '".$this->Email."',Logo = '".$this->Logo."', URL = '".$this->URL."' 
            WHERE ID_Vacante = $this->ID_Vacante";
            
            $resp = $conn->nonQuery($query);
    
            if($resp >= 1)
            {
                return $resp;
            }
            else
            {
                return 0;
            }
            
        }
    

        public function Eliminar($conn,$json)
        {
            $datos = json_decode($json,true);
                
            if(!isset($datos['ID_Vacante']))
            {
                return respuestas::error_400();
            }
            else
            {
                $this->ID_Vacante = $datos['ID_Vacante'];
            }

            $resp =  $this->Query_Eliminar_Vacante($conn);

            if($resp)
            {
                $respuesta = respuestas::$response;
                $respuesta['result'] = array(
                    "ID_Vacante" => $this->ID_Vacante
                );
                return $respuesta;
            }
            else{
                return respuestas::error_500();
            } 

        }

        private function Query_Eliminar_Vacante($conn)
        {
            $query = "DELETE FROM ".Vacante::$Table. " WHERE ID_Vacante = ".$this->ID_Vacante;
            $resp  = $conn->nonQuery($query);
    
            if($resp >= 1)
            {
                return $resp;
            }
            else
            {
                return 0;
            }
        }
}

//$v1 = new Vacante();

//$v1->Guardar('','');




?>