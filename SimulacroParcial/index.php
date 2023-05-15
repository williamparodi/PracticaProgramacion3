<?php
/*A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a que archivo se debe incluir.*/
include_once "PizzaCarga.php";
include_once "PizzaConsultar.php";
include_once "AltaVenta.php";
include_once "ConsultasVentas.php";
include_once "ModificarVenta.php";
include_once "BorrarVenta.php";

$listaPostMan = $_GET["_lista"];

switch($listaPostMan)
{
    case "PizzaConsultar":
        PizzaConsultar::MuestraSiHay();
    break;
    case "PizzaCarga":
        PizzaCarga::AltaPizza();
    break;
    case "AltaVenta":
        AltaVenta::AltaVenta();
        break;
    case "ConsultasVentas":
        ConsultasVentas::MuestraConsultas();
        break;
    case "ModificarVenta":
        ModificarVenta::ModificarPorPut();
        break;
    case "BorrarVenta":
        BorrarVenta::BorrarVenta();
        break;
    default:
        echo "No existe esa lista";
    break;
}

?>