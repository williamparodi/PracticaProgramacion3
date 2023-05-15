<?php
/*
6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar.*/
include_once "venta.php";
class ModificarVenta
{
    public static function ModificarPorPut()
    {
        $datos = json_decode(file_get_contents("php://input"), true);
        $mailUsuario = $datos["_mailUsuario"];
        $sabor = $datos["_sabor"];
        $tipo = $datos["_tipo"];
        $cantidad = $datos["_cantidad"];
        $numeroPedido = $datos["_numeroPedido"];
        Venta::ModificarVenta($sabor, $tipo, $numeroPedido, $mailUsuario, $cantidad);
    }
   
}


?>