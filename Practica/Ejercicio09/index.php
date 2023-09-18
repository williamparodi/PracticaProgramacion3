<?php
/*
Aplicación Nº 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.*/

$colores = array("amarillo","rojo","azul");
$marcas = array("Faber","Best","Cheaper");
$trazos = array("Grueso","Fino");


for($i=0;$i<3;$i++)
{
    $lapicera1 = CargarLapicera($colores,$marcas,$trazos);
    echo "<br/> Lapicera ",$i+1,":";
    foreach($lapicera1 as $k => $valor)
    {
        echo "<br/> $k : $valor";
    }
    echo"<br/>";
}

function CargarLapicera($arrayColores,$arrayMarcas,$arrayTrazo)
{
    $color = array_rand($arrayColores);
    $marca = array_rand($arrayMarcas);
    $trazo = array_rand($arrayTrazo);

    $lapiceraAux['color'] = $arrayColores[$color];
    $lapiceraAux['marca'] = $arrayMarcas[$marca];
    $lapiceraAux['trazo'] = $arrayTrazo[$trazo];
    $lapiceraAux['precio'] = rand(100,1000);

    return $lapiceraAux;
}


?>