<?php
/*
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.*/
require_once "Garage.php";
$path = "garage.csv";

$autoUno = new Auto("Benz","Amarillo");
$autoDos = new Auto("Benz","Azul");

$autoTres = new Auto("Renault","Violeta",500.00);
$autoCuatro = new Auto("Renault","Violeta",600.00);

$autoCinco = new Auto("Ferrari","Chromo",800.00,"04/05/2023");

$garage = new Garage("El peor",56656.00);

$garage->Add($autoUno);
$garage->Add($autoDos);
$garage->Add($autoTres);
$garage->Add($autoCuatro);
$garage->Add($autoCinco);

echo "-----------<br/>";

Garage::GuardarArchivo($path,$garage);
echo "-----Datos del Archivo------<br/>";

Garage::LeerArchivo($path);


?>