<?php
include "auto.php";
/*En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.

● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)*/

$autoUno = new Auto("Benz","rojo",500.00);
$autoDos = new Auto("Benz","azul",400.00);
$autoTres = new Auto("Proto","amarillo",1555.00);
$autoCuatro = new Auto("Proto","amarillo",4500.00);
$autoCinco = new Auto("Chevrolet","gris",5656.00,"03/06/2023");
$precioSumado;

$autoTres->AgregaImpuesto(1500.00);
$autoCuatro->AgregaImpuesto(1500.00);
$autoCinco->AgregaImpuesto(1500.00);

$precioSumado = Auto::Add($autoUno,$autoDos);
echo "El precio sumado de auto1 y auto2 es : $precioSumado<br/>";
echo "------------------<br/>";

if($autoUno->Equals($autoUno,$autoDos))
{
    echo "El auto1 es igual al auto2<br/>";
}
else
{
    echo "No son iguales el auto1 y el auto2<br/>";
}

if($autoUno->Equals($autoUno,$autoCinco))
{
    echo "El auto1 es igual al auto5<br/>";
}
else
{
    echo "No son iguales el auto1 y el auto5 <br/>";
}

echo "------------------<br/>";

echo "Autos inpares: <br/>";
$autoUno->MostrarAuto($autoUno);
echo "------------------<br/>";
$autoTres->MostrarAuto($autoTres);
echo "------------------<br/>";
$autoCinco->MostrarAuto($autoCinco);

?>