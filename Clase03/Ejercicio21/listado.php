<?php

require_once "Usuario.php";

$path = "usuarios.csv";
if(isset($_GET['lista']))
{
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
}
else
{
    echo "Parametro Erroneo <br/>";
}


?>