<?php

include($_SERVER['DOCUMENT_ROOT'].'/AlwaysVacant/Backend/Class/Includes/Conexion.php');

interface IEntidad
{
    function Guardar($conn,$json);
    static function ObtenerTodo($conn,$array);
    static function Obtener($conn,$array);
    function Actualizar($conn,$json);
<<<<<<< HEAD
    function Eliminar($conn,$json);
=======
    function Eliminar($conn,$array);
>>>>>>> 9a240b64040ea82485f3bab7c23efb060c58c6c3
    
}

?>