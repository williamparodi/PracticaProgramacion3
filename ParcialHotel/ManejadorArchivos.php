<?php
class ManejadorArchivos 
{
    private $urlArchivo;

    public function __construct($urlArchivo) {
        $this->urlArchivo = $urlArchivo;
    }


    public function leer() {
        if (file_exists($this->urlArchivo)) {
            $jsonString = file_get_contents($this->urlArchivo);
            $data = json_decode($jsonString, true);
    
            // Si el JSON contiene un solo objeto, lo convierte en un arreglo de un solo elemento
            if (!is_array($data)) {
                $data = [$data];
            }
    
            // Verifica si cada elemento del arreglo es un arreglo asociativo, si no, lo omite
            $filteredData = [];
            foreach ($data as $item) {
                if (is_array($item)) {
                    $filteredData[] = $item;
                }
            }
            return $filteredData;
        } else {
            return [];
        }
    }

    public function guardar($data) {
        // Leer el archivo JSON existente
        $existingData = $this->leer();
    
        // Agregar el nuevo cliente al arreglo existente
        $existingData[] = $data;
    
        // Codificar el arreglo actualizado a formato JSON
        $jsonString = json_encode($existingData);
    
        // Guardar el contenido actualizado en el archivo JSON
        file_put_contents($this->urlArchivo, $jsonString);
    }

    public function guardarImagen($destino,$cliente)
    {
        $nombre_archivo = $_FILES['_imagen']['name'];
        $tipo_archivo = $_FILES['_imagen']['type'];
        $tamano_archivo = $_FILES['_imagen']['size'];

        $extension = pathinfo($nombre_archivo,PATHINFO_EXTENSION);//obtengo la extension
        $clienteImagen = $cliente->_id . $cliente->_tipoCliente;
        $nuevoNombreImagen = $clienteImagen. "." .$extension;//nuevo nombre
        $rutaDestino =  $destino . $nuevoNombreImagen;
        if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 2000000)))
        {
            echo json_encode(['Error en imagen'=>"La extensión o el tamaño de los archivos no es correcta.Se permiten archivos .png 
            o .jpg se permiten archivos de 200 Kb máximo."]);
        }
        else
        {
            if (move_uploaded_file($_FILES['_imagen']['tmp_name'],  $rutaDestino))
            {
                echo json_encode(['Exito'=>"La imagen ha sido cargado correctamente."]);
            }
            else
            {
                echo json_encode(['Error en imagen'=>"Ocurrió algún error al subir el fichero. No pudo guardarse."]);
            }
        }
    }

    public function guardarImagenReserva($destino,$reserva)
    {
        $nombre_archivo = $_FILES['_imagen']['name'];
        $tipo_archivo = $_FILES['_imagen']['type'];
        $tamano_archivo = $_FILES['_imagen']['size'];

        $extension = pathinfo($nombre_archivo,PATHINFO_EXTENSION);//obtengo la extension
        $reservaImagen = $reserva->_tipoCliente . $reserva->_nroCliente . $reserva->_id;
        $nuevoNombreImagen = $reservaImagen. "." .$extension;//nuevo nombre
        $rutaDestino =  $destino . $nuevoNombreImagen;
        if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 2000000)))
        {
            echo json_encode(['Error en imagen'=>"La extensión o el tamaño de los archivos no es correcta.Se permiten archivos .png 
            o .jpg se permiten archivos de 200 Kb máximo."]);
        }
        else
        {
            if (move_uploaded_file($_FILES['_imagen']['tmp_name'],  $rutaDestino))
            {
                echo json_encode(['Exito'=>"La imagen ha sido cargado correctamente."]);
            }
            else
            {
                echo json_encode(['Error en imagen'=>"Ocurrió algún error al subir el fichero. No pudo guardarse."]);
            }
        }
    }
}
?>