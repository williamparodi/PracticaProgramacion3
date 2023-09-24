<?php

require_once("Usuario.php");

echo "<h1>Listado de Usuarios GET</h1><br/>";
if(isset($_GET["lista"]))
{
    $lista = $_GET["lista"];
    if($lista == "usuarios")
    {
        Usuario::ListaUsuarios();
    }
} else {
    echo "Parametro titulo no encontrado";
}


?>