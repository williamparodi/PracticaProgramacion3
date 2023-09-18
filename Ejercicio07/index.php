<?php
/*Jon William Parodi
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach.*/ 

$arrayImpar = array();
$i=0;

do
{
    $num = rand(1,10);
    if($num %2 != 0)
    {
        array_push($arrayImpar,$num);
    }
}while(count($arrayImpar) <= 10);

for($i=0;$i < count($arrayImpar);$i++)
{
    echo "Numeros Impares en for : $arrayImpar[$i]<br/>";
}

foreach($arrayImpar as $valor)
{
    echo "Numeros Impares en foreach : $valor<br/>";
}

while($i < count($arrayImpar))
{
    echo "Numeros Impares en while : $arrayImpar[$i]<br/>";
    $i++;
}


?>