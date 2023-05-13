<?php
/*A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a que archivo se debe incluir.*/
include_once "PizzaCarga.php";
include_once "PizzaConsultar.php";
include_once "AltaVenta.php";

$listaPostMan = $_GET["_lista"];

switch($listaPostMan)
{
    case "PizzaConsultar":
        $sabor = $_GET["_sabor"];
        $tipo = $_GET["_tipo"];
        $pizzaGet = new Pizza($sabor,NULL,$tipo,NULL);
        PizzaConsultar::MuestraSiHay($pizzaGet);
    break;
    case "PizzaCarga":
        $sabror = $_POST["_sabor"];
        $precio = $_POST["_precio"];
        $tipo = $_POST["_tipo"];
        $cantidad = $_POST["_cantidad"];
        $pizzaPost = new Pizza($sabror, $precio, $tipo, $cantidad);
        PizzaCarga::AltaPizza($pizzaPost);
    break;
    case "AltaVenta":
        $mailUsuario = $_POST["_mailUsuario"];
        $sabor = $_POST["_sabor"];
        $tipo = $_POST["_tipo"];
        $cantidad = $_POST["_cantidad"];
        $ventaPost = new Venta($sabor,NULL,$tipo,$cantidad,$mailUsuario);
        AltaVenta::AltaVenta($ventaPost);
        break;
    default:
        echo "No existe esa lista";
    break;
}

?>