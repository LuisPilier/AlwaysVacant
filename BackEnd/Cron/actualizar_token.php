<?php


require_once '../Models/Token.php';

$_token = new token();
$fecha = date('Y-m-d H:i');

$_token->Actualizar($fecha);

$_token->Eliminar($fecha);

?>