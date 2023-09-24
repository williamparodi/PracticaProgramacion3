<?php
require_once "Venta.php";

if(isset($_POST['codigoBarras']) && isset($_POST['idUsuario']) && isset($_POST['cantidadItems']))
{
    $codigoBarras = $_POST['codigoBarras'];
    $idUsuario = $_POST['idUsuario'];
    $cantidaItems = $_POST['cantidadItems'];

    $venta = new Venta($codigoBarras,$idUsuario,$cantidaItems);

    Venta::AltaVenta($venta);
}
else
{
    echo "Datos Erroneos<br/>";
}
?>