<?php
/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”*/


$a = rand(1,10);
$b = rand(1,10);
$c = rand(1,10);

echo "Numero a $a <br/>";
echo "Numero b $b <br/>";
echo "Numero c $c <br/>";

if($a > $b && $a < $c || $a < $b && $a >$c)
{
    echo "El del medio es $a";
}
else if($b > $a && $b < $c || $b < $a && $b > $c)
{
    echo "El del medio es $b";
}
else if($c > $a && $c < $b|| $c < $a && $c > $b)
{
    echo "El del medio es $c";
}
else
{
    echo "No hay valor del medio";
}

?>