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

$autoTres->AgregarImpuestos(1500);
$autoCuatro->AgregarImpuestos(1500);
$autoCinco->AgregarImpuestos(1500);
$garage = new Garage("El peor",56656.00);

$garage->Add($autoUno);
$garage->Add($autoDos);
$garage->Add($autoTres);
$garage->Add($autoCuatro);
$garage->Add($autoCinco);

echo "-----------<br/>";

Garage::GuardarArchivo($path,$garage);
$arrayGarage= Garage::LeerArchivo($path);
echo "-----Datos del Archivo------<br/>";

foreach($arrayGarage as $gar)
{
    $gar->MostarGarage();
}
?>