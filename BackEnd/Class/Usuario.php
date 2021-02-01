<?php

include('IEntidad.php');
include('Conexion.php');

Class Usuario implements IEntidad{

    //Atributos 
    protected $ID_Usuario;
    protected $Nombre;
    protected $Apellido;
    protected $Usuario;
    protected $Contrasena;
    protected $ID_Rol;
    protected $Correo;

    public function __construct($Nombre, $Apellido,$Usuario,$Contrasena,$ID_Rol,$Correo)
    {
        $this->Nombre     = $Nombre;
        $this->Apellido   = $Apellido;  
        $this->Usuario    = $Usuario;
        $this->Contrasena = $Contrasena;
        $this->ID_Rol     = $ID_Rol;
        $this->Correo     = $Correo;
           
    }

    public function Guardar($conn)
    {
        $insert_table  = 'Usuario';
		$insert_fields = array(
		 'Nombre'     => "'$this->Nombre'",
		 'Apellido'   => "'$this->Apellido'",
		 'Usuario' 	  => "'$this->Usuario'",
		 'Contrasena' => "'$this->Contrasena'",
		 'ID_Rol' 	  => "'$this->ID_Rol'",
		 'Correo' 	  => "'$this->Correo'"
		 );

		// Insert record
		$insert_sql = 'INSERT INTO ' . $insert_table
			. ' ('   . implode(', ', array_keys($insert_fields))   . ')'
			. ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';

         echo $conn->nonQuery($insert_sql);
    }

    public static function ObtenerTodo($conn)
    {
        $query = "SELECT * FROM Usuario";
        return $conn->Query($query);
    }

    public static function Obtener($conn,$id)
    {
        $query = "SELECT * FROM Usuario WHERE ID_Usuario = $id";
        return $conn->Query($query);
    }
    public function Actualizar($conn,$id)
    {
        echo '';
    }
    public static function Eliminar($conn,$id)
    {
        $delete_sql = "Delete from Usuario WHERE ID_Usuario = $id";
        echo $conn->nonQuery($delete_sql);
    }

}


?>