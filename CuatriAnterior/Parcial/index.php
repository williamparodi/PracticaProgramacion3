<?php
/*
A- (1 pt.) index.php:
Recibe todas las peticiones que realiza el postman, y administra a qué archivo se debe incluir.*/

$lista = $_GET["_lista"];

switch($lista)
{
    case "HamburguesasCarga":
        include_once "HamburguesaCarga.php";
        break;
    case "HamburguesaConsultar":
        include_once "HamburguesaConsultar.php";
        break;
    default:
        echo "No existe la lista";
        break;
}
?>