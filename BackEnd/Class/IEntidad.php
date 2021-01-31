<?php


interface IEntidad
{
    function Guardar($conn);
    static function ObtenerTodo($conn);
    function Obtener($conn,$id);
    function Actualizar($conn,$id);
    function Eliminar($conn,$id);
    
}

?>