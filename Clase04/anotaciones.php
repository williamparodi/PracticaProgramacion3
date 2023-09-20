<?php
//Subida de archivos 
//$_FILES con esto lo subimos a una capeta temporal y lo guardamos 
$destino = "uploads/".$_FILES["archivo"]["name"];// concateno la ruta donde lo quiero guardar si archivo es "fotoDePerfil"
move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);//mueve un archivo subido y desde y hacia nos devuelve la ruta del archivos
/*
*name = nombre del archivo (con su extensión)
type = tipo del archivo (dado por el navegador
tmp_name = tipo del archivo (dado por el navegador
error = código de error (si es 0, no hubo errores).
size = - tamaño del archivo, medido en bytes.
*/

//Archivos:
//strpos retorna la primera posicion de un substring si no encunetra un png o jprg
//100000 limitamos los bites

/*Como usar el index.php:

siempre post from-data


*/
/*
session_start();

if(isset($_SESSION["usuario"]))
{
    echo $_SESSION["usuario"];
}
else
{
    $_SESSION["usuario"] = "Willy";
    echo "No esta seteada la sesion, se setea";
}
*/

if(isset($_COOKIE['prueba']))
{
    echo "la cookie se creo y el valor es: ";
}
else
{
    echo " la cookie no existe, se crea<br/>";
    setcookie("prueba","willy",time() + (60*2));
}
?>