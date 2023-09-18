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
$autoUno = new Auto("Benz","rojo");
$autoDos = new Auto("Benz","azul");
$autoTres = new Auto("Ford","amarillo",800.00);
$autoCuatro = new Auto("Ford","amarillo",1200.00);
$autoCinco = new Auto("Chevrolet","Violeta",8000.00,"23/07/2023");

$autoTres->AgregarImpuestos(1500.00);
$autoCuatro->AgregarImpuestos(1500.00);
$autoCinco->AgregarImpuestos(1500.00);

echo "El resultado sumado del Auto1 mas el Auto2 es : ".Auto::Add($autoUno,$autoDos)."<br/>";

if($autoUno->Equals($autoUno,$autoDos))
{
    echo "El auto1 y el auto2 son iguales<br/>";
}
else
{
    echo "El auto1 y el auto2 NO son iguales<br/>";
}

if($autoUno->Equals($autoUno,$autoCinco))
{
    echo "El auto1 y el auto5 son iguales<br/>";
}
else
{
    echo "El auto1 y el auto5 NO son iguales<br/>";
}

Auto::GuardarAuto($path,$autoUno);
Auto::GuardarAuto($path,$autoCinco);
Auto::GuardarAuto($path,$autoCuatro);

Auto::LeerAutos($path);


?>