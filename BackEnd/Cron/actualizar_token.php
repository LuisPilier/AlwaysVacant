<?php


require_once '../clases/token_class.php';

$_token = new token();
$fecha = date('Y-m-d H:i');

$_token->InactivarToken($conn,$fecha);

$_token->EliminarToken($conn,$fecha);



?>