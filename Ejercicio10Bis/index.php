<?php
/*
Aplicación Nº 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.*/

$arrayIndexado = array(
    array("Azul","El mejor","Grueso",656),
    array("Celeste","Friesm","Fino",750),
    array("Rojo","Faber Castel","Medio",900));               

$arrayAsociativo["Lapicera 1:"] = array("Azul","El mejor","Grueso",656);
$arrayAsociativo["Lapicera 2:"] = array("Celeste","Friesm","Fino",750);
$arrayAsociativo["Lapicera 3:"] = array("Rojo","Faber Castel","Medio",900);

echo "Lapicera Asociativo: <br/>";

foreach($arrayAsociativo as $k => $valor)
{
    echo "$k <br/>";
    for($i=0;$i< count($arrayAsociativo);$i++)
    {
        echo "$valor[$i] <br/>";
    }
    echo "<br/>";
}

echo "Lapicera Indexado: <br/>";

for($i=0;$i < count($arrayIndexado);$i++)
{
    echo "Lapicera ", $i+1,"<br/>";
    foreach($arrayIndexado[$i] as $valor)
    {
        echo "$valor <br/>";
    }
    echo "<br/>";
}

?>