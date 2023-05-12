<?php
/*
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .*/

include_once "venta.php";

class AltaVenta
{
    public static function AltaVenta($venta)
    {
        $arrayPizza = Pizza::LeeJson();
        $arrayVenta = Venta::LeeJson();
        $pizza = new Pizza($venta->GetSabor(),NULL,$venta->GetTipo(),$venta->GetCantidad());
        if (Pizza::RestaCantidadPizza($arrayPizza, $pizza)) 
        {
            array_push($arrayVenta,$venta);
            if (Pizza::GuardarJson($arrayPizza) && Venta::GuardaJson($arrayVenta))
            {
                echo "Venta Realizada";
            }
            else 
            {
                echo "No se pudo hacer";
            }
        }
        else
        {
            echo "No hay stock de esa pizza";
        }
    }
}

?>