<?php


//INCLUYENDO INTERFACE
include('IEntidad.php');

include('Conexion.php');

//CLASE VACANTE
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
        

        //METODOS

        //METODO HEREDADO DE LA INTERFACE
        public function Guardar($datos)
        {
            $conn = Conexion::getInstance();

            $this->Compania        = $datos['Compania'];
            $this->ID_Tipo_Vacante = $datos['ID_Tipo_Vacante'];
            $this->Posicion        = $datos['Posicion'];
            $this->ID_Ciudad       = $datos['ID_Ciudad'];
            $this->Ubicacion       = $datos['Ubicacion'];
            $this->ID_Categoria    = $datos['ID_Categoria'];
            $this->Email           = isset($datos['Email']) ? $datos['Email'] : '';
            $this->Logo            = isset($datos['Logo'])  ? $datos['Logo']  : '';
            $this->URL             = isset($datos['URL'])   ? $datos['URL']   : '';

            if(isset($datos['Logo']) and $datos['Logo'] != "")
            {
                //Metodo para recibir la imagen y guardarla en el servidor
                $resp = $this->procesarImagen($datos['Logo']);
                $this->Logo = $resp;
            }

            $insert_fields = array(
                'Compania'        => "'$this->Compania'",
                'Logo' 	          => "'$this->Logo'",
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
                
               //Metodo de la Clase Conexion. Retornar el ID insertado    
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

        public function procesarImagen($img)
        {
            //El Directorio donde se almacenaran las imagenes
            $direccion = "../Images/";
            $partes    = explode(";base64,",$img);
            $extension = explode('/',mime_content_type($img))[1];
            $imagen_base64 = base64_decode($partes[1]);

            $nombre_foto = uniqid() . ".".$extension;

            $file = $direccion.''.$nombre_foto;
            
            file_put_contents($file,$imagen_base64);
    
            return $_SERVER['SERVER_NAME'].'/AlwaysVacant/BackEnd/Images/'.$nombre_foto;
    
        }

        //METODO HEREDADO DE LA INTERFACE
        public static function ObtenerTodo()
        {
                $conn = Conexion::getInstance();

                $query = self::Query_Vacante();
                $query .= ' order by v.ID_Vacante desc';
                $datos = $conn->Query($query);
                return $datos;
        }    

        //METODO HEREDADO DE LA INTERFACE
        public static function Obtener($datos)
        {
                $conn = Conexion::getInstance();

                $id = $datos['ID_Vacante'];
                $query = self::Query_Vacante(). ' WHERE v.ID_Vacante = '.$id;
                $datos = $conn->Query($query);
                return $datos;
        }

        //Retorna las Vacantes por Categoria
        public static function Vacantes_Categoria($datos)
        { 
            $conn = Conexion::getInstance();

            $id = $datos['ID_Categoria'];
            $query = self::Query_Vacante(). ' WHERE v.ID_Categoria = '.$id;
            $datos = $conn->Query($query);
            return $datos;

        }

        
        //Query General para retornar todos los datos de la vacante
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
            order by v.ID_Vacante desc
             ";

             return $query;
        }

        //METOOD HEREDADO DE LA INTERFACE
        public function Actualizar($datos)
        {
            $conn = Conexion::getInstance();

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
            

            if(isset($datos['Logo']) and  $datos['Logo'] != '')
            {
                $resp = $this->procesarImagen($datos['Logo']);
                $this->Logo = $resp;
            }

            //Query para actualizar la vacante
            $resp =  $this->Query_Modificar_Vacante($conn);

            return $resp;    
        }
           
        
        

        //Query para modificar las vacantes
        private function Query_Modificar_Vacante($conn)
        {
            $query = "UPDATE ".Vacante::$Table. " SET Compania = '".$this->Compania."',ID_Tipo_Vacante = '".$this->ID_Tipo_Vacante."',
            Posicion = '".$this->Posicion."',ID_Ciudad = '".$this->ID_Ciudad."',Ubicacion = '".$this->Ubicacion."',
            ID_Categoria = '".$this->ID_Categoria."',Email = '".$this->Email."',Logo = '".$this->Logo."', URL = '".$this->URL."' 
            WHERE ID_Vacante = $this->ID_Vacante";
            
            //Metodo de la Clase Conexion. Retorna el numero de filas Afectadas
            $resp = $conn->nonQuery($query);
            
            //Si se afectaron filas de la tabla vacantes
            if($resp >= 1)
            {
                return $resp;
            }
            else
            {
                return 0;
            }
            
        }
    
        //METODO HEREDADO DE LA INTERFACE
        public function Eliminar($datos)
        {
            $conn = Conexion::getInstance();

            $this->ID_Vacante = $datos['ID_Vacante'];

            //Query para eliminar una vacante
            $resp =  $this->Query_Eliminar_Vacante($conn);

            return $resp;
        }  

        //Query para Eliminar Vacante
        private function Query_Eliminar_Vacante($conn)
        {
            $query = "DELETE FROM ".Vacante::$Table. " WHERE ID_Vacante = ".$this->ID_Vacante;
            //Metodo de la Clase conexion que retorna el numero de filas eliminadas
            $resp  = $conn->nonQuery($query);
            
            //Si se eliminaron registros de la BD
            if($resp >= 1)
            {
                return $resp;
            }
            else
            {
                return 0;
            }
        }

        public function retornar_numero()
        {
            return 5;
        }
}




?>