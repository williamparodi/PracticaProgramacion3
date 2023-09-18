<?php
require_once "Usuario.php";

$path = "usuarios.csv";
$mail = $_POST['mail'];
$clave = $_POST['clave'];

$usuario = new Usuario($mail,$clave);

Usuario::AltaUsuario($path,$usuario);




?>