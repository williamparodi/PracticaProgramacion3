<?php
/*
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.*/ 

$lapicera1["color"] = "rojo";
$lapicera1["marca"] = "Buena";
$lapicera1["trazo"] =  "grueso";
$lapicera1["precio"] =  500.63;

$lapicera2["color"] = "amarillo";
$lapicera2["marca"] = "Excelente";
$lapicera2["trazo"] =  "fino";
$lapicera2["precio"] =  800.56;

$lapicera3["color"] = "azul";
$lapicera3["marca"] = "Muy buena";
$lapicera3["trazo"] =  "fino";
$lapicera3["precio"] =  1855.63;

echo "Lapicera 1 : <br/>";

foreach($lapicera1 as $k => $valor)
{
    echo "$k = $valor <br/>";
}
echo "------------------<br/>";

echo "Lapicera 2 : <br/>";
foreach($lapicera2 as $k => $valor)
{
    echo "$k = $valor <br/>";
}

echo "------------------<br/>";

echo "Lapicera 3 : <br/>";
foreach($lapicera3 as $k => $valor)
{
    echo "$k = $valor <br/>";
}
?>