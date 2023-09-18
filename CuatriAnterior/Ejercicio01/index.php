<?php
/*
Aplicación Nº 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
*/

$total = 0;
$contador = 0;
$numero = rand(1,100);

for($i=0;$total < 1000;$i++)
{
    print("<br/> Los numeros sumados son: $total y $numero");
    $total += $numero;
    $contador++;
}

print("<br/>La cantidad de numero es $contador");
?>