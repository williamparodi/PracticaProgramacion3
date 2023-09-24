<?php
/*
Aplicación Nº 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un objeto y
utilizar sus métodos para poder verificar si es un producto existente, si ya existe el producto se le
suma el stock , de lo contrario se agrega al documento en un nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase*/
require_once "Producto.php";
if(isset($_POST['_codigoBarras']) && isset($_POST['_nombre']))
{
    $codigoBarras = $_POST['_codigoBarras'];
    $nombre = $_POST['_nombre'];
    $tipo = $_POST['_tipo'];
    $stock = $_POST['_stock'];
    $precio = $_POST['_precio'];

    $producto = new Producto($codigoBarras,$nombre,$tipo,$stock,$precio);

    Producto::AltaProducto($producto);

}
?>
