<?php
/*Jon William Parodi 
Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.*/

$arrayEnteros = array(rand(1,10),rand(1,10),rand(1,10),rand(1,10),rand(1,10));
$acumulador = 0;
$cantidad = 5;
$promedio;

for($i=0;$i < count($arrayEnteros);$i++)
{
    $acumulador+=$arrayEnteros[$i];
}

$promedio = $acumulador / $cantidad;
echo "Promedio: $promedio<br/>";

if($promedio > 6)
{
    echo "El promedio es mayor a 6";
}
else if($promedio < 6)
{
    echo "El promedio es menor a 6";
}
else
{
    echo "El promedio es igual a 6";
}

?>