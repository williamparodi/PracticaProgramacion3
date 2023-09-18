<?php
/*
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. ● Crear
un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)*/
require_once "Auto.php";
$path = "autos.csv";


$autoUno = new Auto("Benz","Amarillo");
$autoDos = new Auto("Benz","Azul");

$autoTres = new Auto("Renault","Violeta",500.00);
$autoCuatro = new Auto("Renault","Violeta",600.00);

$autoCinco = new Auto("Ferrari","Chromo",800.00,"04/05/2023");

$arrayAutos = Auto::LeerArchivo($path);

Auto::AltaAuto($autoUno);
Auto::AltaAuto($autoDos);
Auto::AltaAuto($autoTres);
Auto::AltaAuto($autoCuatro);
Auto::AltaAuto($autoCinco);

$autoTres->AgregarImpuestos(1500);
$autoCuatro->AgregarImpuestos(1500);
$autoCinco->AgregarImpuestos(1500);

$importeSumado = Auto::Add($autoUno,$autoDos);

echo "El importe sumado es: $importeSumado <br/>";

if($autoUno->Equals($autoUno,$autoDos))
{
    echo "El autoUno y el autoDos son iguales <br/>";
}
else
{
    echo "El autoUno y el autoDos NO son iguales <br/>";
}   
if($autoUno->Equals($autoUno,$autoCinco))
{
    echo "El autoUno y el autoCinco son iguales <br/>";   
}
else
{
    echo "El autoUno y el autoCinco NO son iguales <br/>";  
}

$arrayAutos = Auto::LeerArchivo($path);

for($i=0;$i < count($arrayAutos);$i++)
{
    echo $i."<br/>";
    if($i %2 == 0)
    {
        Auto::MostrarAuto($arrayAutos[$i]);
    }
}

?>