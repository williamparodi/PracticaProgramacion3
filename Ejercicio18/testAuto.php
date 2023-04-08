<?php
/*En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos.*/

include_once "index.php";
include_once "auto.php";

$auto1 = new Auto("El peor","Rojo");
$auto2 = new Auto("El peor","Azul");
$auto3 = new Auto("Chevrolet","Rojo",3450.00);
$auto4 = new Auto("Ford","Rojo",4350.00,"06/65/22");
$auto5 = new Auto("Mercedez","Rosa",43434.00,"23/03/23");

$garage1 = new Garage("Responsable Inscripto");
$garage2 = new Garage("Monotributista",560.6);

$garage1->Add($auto1);
$garage1->Add($auto2);
$garage1->Add($auto3);

$garage2->Add($auto1);
$garage2->Add($auto3);
$garage2->Add($auto5);
echo "<br/>";

$garage1->MostrarGarage();
echo "<br/>";
$garage2->MostrarGarage();

$garage1->Remove($auto1);
$garage1->Remove($auto5);
$garage1->Remove($auto4);
$garage1->Add($auto4);
$garage1->Remove($auto4);

echo "<br/>";
$garage1->MostrarGarage();

?>