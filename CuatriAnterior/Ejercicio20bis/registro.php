<?php
include_once "usuario.php";

$nombre = $_POST['nombre'];
$clave = $_POST['clave'];
$mail = $_POST['mail'];

$usuario = new usuario($nombre,$clave,$mail);

if(Usuario::AgregaUsuario($usuario))
{
    echo "Se agrego el usuario <br/>";
}
else
{
    echo "No se agrego ya existe un usuario con ese mail<br/>";
}

?>