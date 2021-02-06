<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/Backend/Class/Includes/Conexion.php');

interface IEntidad
{
    function Guardar($conn,$json);
    static function ObtenerTodo($conn,$json);
    static function Obtener($conn,$json);
    function Actualizar($conn,$json);
    static function Eliminar($conn,$json);
    
}

?>