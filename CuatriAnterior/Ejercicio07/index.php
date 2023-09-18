<?php
/*
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach*/

$numeroRandom;
$vecImpares = array();
$i = 0;

while(count($vecImpares) < 10)
{
    $numeroRandom = rand(1,10); 
    if($numeroRandom % 2 != 0)
    {
        $vecImpares[] = $numeroRandom;
    }
}

while($i<10)
{
    echo "<br/> Impresión impares while: $vecImpares[$i]";
    $i++;
}

for($i=0;$i < count($vecImpares);$i++)
{
    echo "<br/> Impresión impares for: $vecImpares[$i]";
}

foreach($vecImpares as $valor)
{
    echo "<br/> Impresion impares foreach:  $valor";
}

?>