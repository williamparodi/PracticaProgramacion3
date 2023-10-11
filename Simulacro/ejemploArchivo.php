<?php


// Ejemplo de uso
$rutaArchivo = 'data.json';

// Crear una instancia del ManejadorArchivos
$manejadorArchivos = new ManejadorArchivos($rutaArchivo);

// Leer el archivo
$data = $manejadorArchivos->leer();

// Modificar los datos (agregar un nuevo objeto JSON)
$nuevoObj = ['id' => 1, 'nombre' => 'Franco'];
$data[] = $nuevoObj;

// Escribir los datos de vuelta en el archivo
$manejadorArchivos->guardar($data);
?>