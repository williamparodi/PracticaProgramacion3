<?php
include_once "index.php";

$auto1 = new Auto("El peor","Rojo");
$auto2 = new Auto("El peor","Azul");
$auto3 = new Auto("Chevrolet","Rojo",3450.00);
$auto4 = new Auto("Chevrolet","Rojo",4350.00);
$auto5 = new Auto("Mercedez","Rosa",43434.00,"23/03/23");

$impuestos = (double)1500;
$total = (double)0;

$auto3->AgregarImpuestos($impuestos);
$auto4->AgregarImpuestos($impuestos);
$auto5->AgregarImpuestos($impuestos);

$total = Auto::Add($auto1,$auto2);
echo "El precio total de los autos 1 mas el 2 es de: $total <br/>";

if($auto3->Equals($auto2,$auto5))
{
    echo "El segundo y quinto auto son iguales <br/>";
}
else
{
    echo "El segundo y quinto auto no son iguales <br/>";
}
echo "<br/>";
echo Auto::MostrarAuto($auto1);
echo Auto::MostrarAuto($auto3);
echo Auto::MostrarAuto($auto5);

?>