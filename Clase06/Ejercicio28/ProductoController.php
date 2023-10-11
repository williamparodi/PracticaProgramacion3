<?php
require_once "Producto.php";

class ProductoController
{
    public function insertarProducto($codigoBarras,$nombre,$tipo,$stock,$precio) 
    {   
        $nuevoProducto = new Producto();
        $nuevoProducto->_codigoBarras = $codigoBarras;
        $nuevoProducto->_nombre = $nombre;
        $nuevoProducto->_tipo = $tipo;
        $nuevoProducto->_stock = $stock;
        $nuevoProducto->_precio = $precio;
        return $nuevoProducto->insertarElProducto();
    }

    public function listarProductos() 
    {
        return Producto::TraerTodosLosProductos();
    }

}
?>