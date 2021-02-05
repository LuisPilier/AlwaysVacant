<?php

include('Respuestas.php');

//Clases
class Conexion {
     
    //Atributos
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    public $conexion;
    
    //Funciones
    function __construct(){
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
         
        if($this->conexion->connect_errno){
            echo "Algo va mal con la conexion";
            die();
        }
        else
        {
            'Conexion Exitosa';
        }
        
    
    }

    
    private function datosConexion()
    {    
        $jsondata = file_get_contents("../Database/Conexion.json");
        return json_decode($jsondata, true);
    }

    private function convertirUTF8($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,'utf-8',true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    //SELECT
    public function Query($sqlstr){
        $results = $this->conexion->query($sqlstr);
        $resultArray = array();
        foreach ($results as $key) {
            $resultArray[] = $key;
        }
        return $this->convertirUTF8($resultArray);

    }


    //UPDATE Y DELETE
    public function nonQuery($sqlstr){
        $results = $this->conexion->query($sqlstr);
        return $this->conexion->affected_rows;
    }

    //INSERT
    public function nonQueryId($sqlstr)
    {
        $results = $this->conexion->query($sqlstr);
        $filas   = $this->conexion->affected_rows;

        if($filas >= 1)
        {
            return $this->conexion->insert_id;
        }
        else {
            // code...
            return 0;
        }
    }



    

}

$conn = new Conexion();

?>