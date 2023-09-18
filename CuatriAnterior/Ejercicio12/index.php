<?php
/*Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/

$palabraAinvertir ="hola";
$palabraAlRevez = " ";

$palabraAlRevez = inviertePalabra($palabraAinvertir);

echo $palabraAlRevez;

function inviertePalabra($palabra)
{   
    $palabraRetorno = strrev($palabra);
    return $palabraRetorno;
}

?>