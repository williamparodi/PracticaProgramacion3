<?php
/*
Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario*/

require_once "Usuario.php";

$path = "usuarios.csv";
$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];

$usuario = new Usuario($nombre,$clave,$mail);

Usuario::AltaUsuario($path,$usuario);

$arrayUsuarios = Usuario::LeeUsuarios($path);

foreach($arrayUsuarios as $u)
{
    Usuario::MostarUsuario($u);
}
?>