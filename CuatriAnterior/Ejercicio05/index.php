<?php
/*
Aplicación Nº 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
*/

$num = rand(20,60);
$numeroEscrito = " ";
$numeroEscrito2 = " ";

echo "El numero es: $num";
echo "<br/>";

if($num == 20)
{
    $numeroEscrito = "veinte";
    echo "El numero escrito es: $numeroEscrito";
}
else if($num == 60)
{
    $numeroEscrito = "sesenta";
    echo "El numero escrito es: $numeroEscrito";

}
else if($num > 20 && $num <30)
{
    $numeroEscrito = "vienti";
    $num = $num - 20;
    $numeroEscrito2 = nombraNumero($num);
    echo "El numero escrito es : $numeroEscrito$numeroEscrito2";
}
else if($num >=30 && $num <= 39)
{
    $numeroEscrito = "treinta";
    $num = $num - 30;
    $numeroEscrito2 = nombraNumero($num);
    echo "El numero escrito es : $numeroEscrito y $numeroEscrito2";
}
else if($num >= 40 && $num <= 49)
{
    $numeroEscrito = "cuarenta";
    $num = $num - 40;
    $numeroEscrito2 = nombraNumero($num);
    echo "El numero escrito es : $numeroEscrito y $numeroEscrito2";
}
else
{
    $numeroEscrito = "cincuenta";
    $num = $num - 50;
    $numeroEscrito2 = nombraNumero($num);
    echo "El numero escrito es : $numeroEscrito y $numeroEscrito2";
}

function nombraNumero($numero)
{
    $numeroRetorno = " ";
    switch($numero)
    {
        case 1:
            $numeroRetorno = "uno";
            break;
        case 2:
            $numeroRetorno = "dos";
            break;
        case 3:
            $numeroRetorno = "tres";
            break;
        case 4:
            $numeroRetorno = "cuatro";
            break;
        case 5:
            $numeroRetorno = "cinco"; 
            break;
        case 6:
            $numeroRetorno = "seis"; 
            break;
        case 7:
            $numeroRetorno = "siete";
            break;
        case 8:
            $numeroRetorno = "ocho";
            break;
        case 9:
            $numeroRetorno = "nueve";
            break;
        default:
            break;
    }
    
    return $numeroRetorno;
}
?>