<?php
/*
Parte 9 - Ejercicios PDO
Aplicación Nº 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , crear
un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.*/

include_once "usuario.php";

$nombre = $_POST["_nombre"];
$apellido = $_POST["_apellido"];
$clave = $_POST["_clave"];
$mail = $_POST["_mail"];
$fechaRegistro = new DateTime();

$usuarioPost = new Usuario($nombre,$apellido,$clave,$mail,$fechaRegistro);

Usuario::AltaUsuario($usuarioPost);

?>