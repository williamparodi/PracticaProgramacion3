<?php

require_once "Usuario.php";

$path = "usuarios.csv";
$lista = $_GET['lista'];

if($lista == "usuarios")
{
    $usuarios = Usuario::LeeUsuarios($path);
    Usuario::MuestraLista($usuarios);
}
else
{
    echo "Lista no valida <br/>";
}

?>