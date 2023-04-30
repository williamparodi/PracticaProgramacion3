<?php

include_once "producto.php";

$codigoBarras =$_POST['_codigoBarras'];
$nombre = $_POST['_nombre'];
$tipo = $_POST['_tipo'];
$stock = $_POST['_stock'];
$precio = $_POST['_precio'];

$productoPost= new Producto($codigoBarras,$nombre,$tipo,$stock,$precio);

Producto::AltaProducto($productoPost);

?>