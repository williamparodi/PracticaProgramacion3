<?php
/*
4- (3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de pizzas vendidas
b- el listado de ventas entre dos fechas ordenado por sabor.
c- el listado de ventas de un usuario ingresado
d- el listado de ventas de un sabor ingresado*/
include_once "venta.php";

class ConsultasVentas
{    
    public static function MuestraConsultas()
    {
        $sabor = $_GET["_sabor"];
        $mailUsuario = $_GET["_mailUsuario"];
        $fecha1 = $_GET["_fecha1"];
        $fecha2 = $_GET["_fecha2"];

        echo "a-Cantidad de pizzas vendidas : ".Venta::CalculaCantidadVendida()."<br/>";
        echo "b-Listado de ventas entre dos fechas: ".Venta::ListaVentasEntreFechas($fecha1,$fecha2)."<br/>";
        echo "c-Listado de ventas de un usuario: ".Venta::ListaPorUsuario($mailUsuario)."<br/>";
        echo "d-El listado de ventas de un sabor ingresado: ".Venta::ListaPorSabor($sabor)."<br/>";
    }
}

?>