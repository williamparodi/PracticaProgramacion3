<?php
/*Aplicación Nº 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/ 

$saludo= "Hola";
//$saludoAlRevez= strrev($saludo);//funcion facil 
$saludoAlRevez = InviertePalabra($saludo);
echo $saludoAlRevez;

function InviertePalabra($palabra)
{
    $palabraInvertida = "";
    $largo = strlen($palabra);
    for($i=$largo -1;$i>=0;$i--)
    {
        $palabraInvertida.=$palabra[$i];
    }
    return $palabraInvertida;
}
?>