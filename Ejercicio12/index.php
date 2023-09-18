<?php
/*
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/ 

$saludo = array("h","o","l","a");
$saludoAlrevez = InveriertePalabra($saludo);

foreach($saludoAlrevez as $valor)
{
    echo $valor;
}

function InveriertePalabra($palabra)
{
    $palabraInvertida = array();
    $palabraInvertida = array_reverse($palabra);
    return $palabraInvertida;
} 


?>