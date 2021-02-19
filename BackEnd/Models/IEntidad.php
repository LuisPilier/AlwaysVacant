<?php

//include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/BackEnd/Class/Includes/Conexion.php');

interface IEntidad
{
    function Guardar($datos);
    static function ObtenerTodo($datos);
    static function Obtener($datos);
    function Actualizar($datos);
    function Eliminar($datos);
    
}


?>