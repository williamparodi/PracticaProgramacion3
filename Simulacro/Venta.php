<?php
/*
3-
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta
*/
require_once 'Pizza.php';

class Venta extends Pizza
{
    public $_mailUsuario;
    public $_fechaDePedido;
    public $_numeroPedido;
    public $_id;
    public static $_idAutoincremental= 1;

    public function __construct($sabor, $precio, $tipo, $cantidad, $mailUsuario, $numeroPedido)
    {
        parent::__construct($sabor, $precio, $tipo, $cantidad);
        $this->_mailUsuario = $mailUsuario;
        $this->_numeroPedido = $numeroPedido;
        $this->_id = ++Venta::$_idAutoincremental;
        $this->_fechaDePedido = new DateTime();
    }
    
    
}
?>