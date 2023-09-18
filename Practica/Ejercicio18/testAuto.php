<?php
include_once "auto.php";
include_once "garage.php";

$autoUno = new Auto("Benz","rojo",500.00);
$autoDos = new Auto("Benz","azul",400.00);
$autoTres = new Auto("Proto","amarillo",1555.00);
$autoCuatro = new Auto("Proto","amarillo",4500.00);
$autoCinco = new Auto("Chevrolet","gris",5656.00,"03/06/2023");

$garage1 = new Garage("Pistige");
$garage2 = new Garage("Caro",500.00);

$garage1->Add($autoUno);
$garage1->Add($autoTres);
$garage1->Add($autoUno);

$garage2->Add($autoCuatro);
$garage2->Add($autoDos);
$garage2->Add($autoCinco);

echo "Garage 1<br/>";
$garage1->MostrarGarage();
echo "--------------<br/>";
echo "Garage 2<br/>";
$garage2->MostrarGarage();

$garage1->Remove($autoUno);
$garage1->Remove($autoCinco);

$garage2->Remove($autoUno);
$garage2->Remove($autoCinco);
echo "-----Despues de borrar------------<br/>";

echo "Garage 1<br/>";
$garage1->MostrarGarage();
echo "--------------<br/>";
echo "Garage 2<br/>";
$garage2->MostrarGarage();

?>