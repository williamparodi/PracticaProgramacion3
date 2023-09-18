<?php
/*Jon William Parodi
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.*/

$suma =0;
$contador = 0;

while($suma < 1000)
{
    $numero = rand(1,100);
    echo "Numero a sumar :$numero<br/>";
    if($suma+$numero < 1000)
    {
        $suma+=$numero;
        $contador++;
    }
    else
    {
        break;
    }
}

echo "La suma es : $suma y la cantidad de numeros sumados es $contador <br/>";
?>