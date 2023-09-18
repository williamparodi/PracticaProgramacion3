<?php
/*Jon William Parodi
Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.*/ 

$num = rand(20,60);
echo "Numero: $num<br/>";
$numEscrito1;
$numEscrito2;

if($num >20 && $num <30)
{
    $numEscrito1="veinti";
    $numAux= $num - 20;
    $numEscrito2 = nombraNumero($numAux);
    echo "El numero escrito es $numEscrito1$numEscrito2<br/>";
}
else if($num >= 30 && $num < 40)
{
    $numEscrito1="treinta";
    $numAux= $num - 30;
    $numEscrito2 = nombraNumero($numAux);
    if($num == 30)
    {
        echo "El numero escrito es $numEscrito1<br/>";
    }
    else
    {
        echo "El numero escrito es $numEscrito1 y $numEscrito2<br/>";
    }
}
else if($num >=40 && $num <50)
{
    $numEscrito1="cuarenta";
    $numAux= $num - 40;
    $numEscrito2 = nombraNumero($numAux);
    if($num == 40)
    {
        echo "El numero escrito es $numEscrito1<br/>";
    }
    else
    {
        echo "El numero escrito es $numEscrito1 y $numEscrito2<br/>";
    }
}
else if($num >=50 && $num < 60)
{
    $numEscrito1="cincuenta";
    $numAux= $num - 50;
    $numEscrito2 = nombraNumero($numAux);
    if($num == 50)
    {
        echo "El numero escrito es $numEscrito1<br/>";
    }
    else
    {
        echo "El numero escrito es $numEscrito1 y $numEscrito2<br/>";
    }
}
else if($num == 60)
{
    echo "El numero escrito es sesenta";
}
else
{
    echo "El numero escrito es veinte";
} 

//Funcion
function nombraNumero($numero)
{
    $numeroEscrito= "";
    switch($numero)
    {
        case 1:
            $numeroEscrito="uno";
            break;
        case 2:
            $numeroEscrito="dos";
            break;
        case 3:
            $numeroEscrito="tres";
            break;
        case 4: 
           $$numeroEscrito="cuatro";
           break;
        case 5:
            $numeroEscrito="cinco";
            break;
        case 6:
            $numeroEscrito="seis";
            break;
        case 7: 
            $numeroEscrito="siete";
            break;
        case 8:
            $numeroEscrito="ocho";
            break;
        case 9:
            $numeroEscrito="nueve";
            break;
        default:
            break;
    }

    return $numeroEscrito;
}



?>