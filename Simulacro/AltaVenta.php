<?php
/*
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
*/
require_once "Venta.php";
require_once "Pizza.php";
require_once "ManejadorArchivos.php";

class AltaVenta
{
    
    public static function AltaVenta($venta)
    {
        $flag = false;
        $rutaArchivo = '/Ventas/ventas.json';
        $manejador = new ManejadorArchivos($rutaArchivo);
        if($venta != NULL)
        {
            $arrayPizza = Pizza::LeeJson();
            if($arrayPizza != NULL && count($arrayPizza) > 0)
            {
                foreach($arrayPizza as $p)
                {
                    if($p->Equals($venta))
                    {
                        $flag = true;
                        break;
                    }
                }
                if($flag)
                {
                    if(Pizza::RestaStockPizza($arrayPizza,$venta))
                    {
                        echo json_encode(['venta'=> 'Venta realizada']);
                        Pizza::GuardaJson($arrayPizza);
                        $manejador->guardar($venta);
                    } 
                }
                else
                {
                    echo json_encode(['venta'=> 'No hay stock de esa pizza']);
                }
            }
        }
    }
}

?>