<?php

/*Aplicación Nº 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.*/

$vec[0] = rand(1,10);
$vec[1] = rand(1,10);
$vec[2] = rand(1,10);
$vec[3] = rand(1,10);
$vec[4] = rand(1,10);

$acumulador = 0;
$promedio;
$numeroComparador = 6;

foreach($vec as $valor)
{
    echo "<br/> Los numeros son: ", $valor;
    $acumulador+=$valor;
}

if($acumulador>0)
{
    $promedio = $acumulador / 5;

    if($promedio > $numeroComparador)
    {
        echo "<br/> El promedio es mayor a 6 (Promedio:$promedio)";
    }
    else if($promedio < $numeroComparador)
    {
        echo "<br/> El promedio es menor a 6 (Promedio:$promedio)";
    }
    else
    {
        echo "<br/> El promedio es igual a 6 (Promedio:$promedio)";  
    }
}