<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/Backend/Class/Includes/Conexion.php');

interface IEntidad
{
    function Guardar($conn,$json);
    static function ObtenerTodo($conn,$array);
    static function Obtener($conn,$array);
    function Actualizar($conn,$json);
    function Eliminar($conn,$json);
    
}

?>