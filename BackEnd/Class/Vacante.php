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
            $insert_sql = 'INSERT INTO ' . $this->Table
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

        private static function Query_Vacante()
        {
            $query = "
            SELECT v.Compania ,v.Logo ,v.URL URL,v.Posicion Posicion,v.Descripcion
            ,ci.Nombre Ciudad,c.Nombre Categoria,
            tv.Nombre TipoVacante,v.Email Email,v.Ubicacion Ubicacion
            FROM Vacante v
            INNER JOIN Categoria c on c.ID_Categoria = v.ID_Categoria
            INNER JOIN Ciudades ci on ci.ID_Ciudad = v.ID_Ciudad
            INNER JOIN Tipo_Vacante tv on tv.ID_Tipo_Vacante = v.ID_Tipo_Vacante
             ";

             return $query;
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

//$v1 = new Vacante();

//$v1->Guardar('','');




?>