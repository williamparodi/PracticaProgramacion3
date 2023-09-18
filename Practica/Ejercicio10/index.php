<?php
/*Aplicación Nº 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays*/

$colores = array("amarillo","rojo","azul");
$marcas = array("Faber","Best","Cheaper");
$trazos = array("Grueso","Fino");

$lapicera1 = CargarLapicera($colores,$marcas,$trazos);
$lapicera2 = CargarLapicera($colores,$marcas,$trazos);
$lapicera3 = CargarLapicera($colores,$marcas,$trazos);

$lapicero1=array($lapicera1,$lapicera2,$lapicera3);
$lapicero2['Lapicera1'] = $lapicera1;
$lapicero2['Lapicera2'] = $lapicera2;
$lapicero2['Lapicera3'] = $lapicera3;

$num=0;
echo "<br/>Array Indexado: ";
for($i=0;$i < count($lapicero1);$i++)
{
    echo "<br/> Lapicera", $num+1,":";
    foreach($lapicero1[$i] as $k=> $valor)
    {
        echo "<br/> $k: $valor";
    }
}
echo "<br/>";
echo "<br/> Array Asociativo: ";
foreach ($lapicero2 as $k => $valor) 
{
    echo "<br/> $k :";
    foreach ($valor as $k2 => $caracteristica) 
    {
        echo "<br/> $k2: $caracteristica";
    }
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