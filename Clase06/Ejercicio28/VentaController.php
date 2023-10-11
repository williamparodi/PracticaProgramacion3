<?php
require_once "Venta.php";

class VentaController
{
    public function insertarProducto($cantidadItems,$idUsuario,$fechaDeVenta) 
    {   
        $nuevaVenta = new Venta();
        $nuevaVenta->_cantidadItems = $cantidadItems;
        $nuevaVenta->_idUsuario = $idUsuario;
        $nuevaVenta->_fecha_de_venta = $fechaDeVenta;
        return $nuevaVenta->InsertarLaVenta();
    }

    public function listarVentas() 
    {
        return Venta::TraerTodasLasVentas();
    }
    
}
?>