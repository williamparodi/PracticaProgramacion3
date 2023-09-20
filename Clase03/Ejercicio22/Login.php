<?php
require_once "Usuario.php";

$path = "usuarios.csv";

if(isset($_POST['mail']) && isset($_POST['clave']))
{
    $mail = $_POST['mail'];
    $clave = $_POST['clave'];
    $usuario = new Usuario($mail,$clave);

    //Usuario::AltaUsuario($path,$usuario);

    Usuario::LogueaUsuario($path,$usuario);
}
else
{
    echo "Parametros erroneos <br/>";
}

?>