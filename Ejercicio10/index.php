<?php
/*Jon William Parodi 
Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.*/ 

$lapi1["color"] = "rojo";
$lapi1["marca"] = "Buena";
$lapi1["trazo"] =  "grueso";
$lapi1["precio"] =  500.63;

$lapi2["color"] = "amarillo";
$lapi2["marca"] = "Excelente";
$lapi2["trazo"] =  "fino";
$lapi2["precio"] =  800.56;

$lapi3["color"] = "azul";
$lapi3["marca"] = "Muy buena";
$lapi3["trazo"] =  "fino";
$lapi3["precio"] =  1855.63;

$lapicero1["Lapicera 1"] = $lapi1;
$lapicero1["Lapicera 2"] = $lapi2;
$lapicero1["Lapicera 3"] = $lapi3;

echo "Array asociativo : <br/>";

$lapicero2[0] = $lapi1;
$lapicero2[1] = $lapi2;
$lapicero2[2] = $lapi3;

foreach($lapicero1 as $k=> $valor)
{
    echo "$k : <br/>";
    foreach($valor as $k2=> $valor2)
    {
        echo "$k2 : $valor2 <br/>";
    }
    echo "-----------------<br/>";
}

echo "Array Indexado : <br/>";

foreach($lapicero2 as $k=> $valor)
{
    echo "$k : <br/>";
    foreach($valor as $k2=> $valor2)
    {
        echo "$k2 : $valor2 <br/>";
    }
    echo "-----------------<br/>";
}

?>