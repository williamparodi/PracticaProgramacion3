<?php
/*
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach*/ 

$numerosImpares = array();

while(count($numerosImpares) < 10)
{
    $num = rand(1,10);
    if($num % 2 != 0)
    {
        array_push($numerosImpares,$num);
    }
}

for($i=0;$i< count($numerosImpares);$i++)
{
    echo "<br/>Numeros impares con for: $numerosImpares[$i]";
}

$i=0;
while($i<10)
{
    echo "<br/>Numeros impares con while: $numerosImpares[$i]";
    $i++;
}

foreach($numerosImpares as $valor)
{
    echo "<br/>Numeros impares con foreach: $valor";
}
?>