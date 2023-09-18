<?php
/*
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. 
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)*/

include_once "auto.php";
$arrayAutos = array();
$resultadoSuma;

$marca = $_POST['marca'];
$color = $_POST['color'];
$precio = $_POST['precio'];
$fecha = $_POST['fecha'];

$autoPostman = new Auto($marca,$color,$precio,$fecha);
Auto::AltaAuto($autoPostman);
$arrayAutos = Auto::LeerAutos();
//array_push($arrayAutos,$autoPostman);

$arrayAutos[2]->AgregarImpuesto(1500.00);
$arrayAutos[3]->AgregarImpuesto(1500.00);
$arrayAutos[4]->AgregarImpuesto(1500.00);

$resultadoSuma = Auto::Add($arrayAutos[0],$arrayAutos[1]);
echo "La suma es de: ".$resultadoSuma. "<br/>";

if($autoPostman->Equals($arrayAutos[0],$arrayAutos[1]))
{
    echo "El auto 1 y el 2 son iguales <br/>";
}
else
{
    echo "El auto 1 y el 2 no son iguales <br/>";
}
if($autoPostman->Equals($arrayAutos[0],$arrayAutos[4]))
{
    echo "El auto 1 y el 5 son iguales <br/>";
}
else
{
    echo "El auto 1 y el 5 no son iguales <br/>";
}

for($i=0;$i<count($arrayAutos);$i++)
{
    if($i % 2!= 0)
    {
        Auto::MostrarAuto($arrayAutos[$i]);
    }
}   

?>