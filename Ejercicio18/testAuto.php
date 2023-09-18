<?php
require_once "Garage.php";

$autoUno = new Auto("Benz","rojo");
$autoDos = new Auto("Benz","azul");
$autoTres = new Auto("Ford","amarillo",800.00);
$autoCuatro = new Auto("Ford","amarillo",1200.00);
$autoCinco = new Auto("Chevrolet","Violeta",8000.00,"23/07/2023");

$garage1 = new Garage("Mataderos");
$garage2 = new Garage("Tortuguitas",456.00);

//Añado al garage 1
$garage1->Add($autoTres);
$garage1->Add($autoTres);
echo "---------------<br/>";
//Muestro garages
echo "Garage 1: <br/>";
$garage1->MostarGarage();

echo "---------------<br/>";
echo "Garage 2: <br/>";
$garage2->MostarGarage();
echo "---------------<br/>";

//Borro en el garage 1
$garage1->Remove($autoUno);
$garage1->Remove($autoTres);
echo "Garage 1: <br/>";
$garage1->MostarGarage();

echo "---------------<br/>";
//Añado al dos y muestro: 
$garage2->Add($autoDos);
$garage2->Add($autoCuatro);
$garage2->Add($autoCinco);
$garage2->MostarGarage();


?>