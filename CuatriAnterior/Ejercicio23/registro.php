<?php
/*
Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.*/

include_once "usuario.php";
$nombre = $_POST['nombre'];
$mail = $_POST['mail'];
$clave = $_POST['clave'];

$usuarioPost = new Usuario($nombre,$clave,$mail);

if($usuarioPost->AltaUsuario($usuarioPost))
{
    echo "Usuario agregado <br/>";
}
else
{
    echo "Error al agregar usuario  <br/>";
}

?>