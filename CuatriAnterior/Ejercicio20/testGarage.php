<?php
/*Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.*/
include_once "garage.php";
include_once "auto.php";

$auto1 = new Auto("Ferrari","Rojo",656,"23/05/23");
$auto2 = new Auto("Lambo","Violeta",455,"05/05/22");
$auto3 = new Auto("Lambo","Violeta",455,"05/05/22");
$auto4 = new Auto("Volvo","Amarillo",455,"05/05/22");
$auto5 = new Auto("Citroen","Plateado",45566,"06/09/98");
$garage = new Garage("Alto Garage",500.00);

$garage->Add($auto1);
$garage->Add($auto2);
$garage->Add($auto3);
$garage->Add($auto4);
$garage->Remove($auto5);
$garage->MostrarGarage($garage);
$garage->Remove($auto2);
$garage->MostrarGarage($garage);

//Probando archivos
Garage::AltaGarge($garage);
$arrayGarage = array();
$arrayGarage = Garage::LeeUnGarage();

?>