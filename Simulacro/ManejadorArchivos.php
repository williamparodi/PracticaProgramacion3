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
            return json_decode($jsonString, true);
        } else {
            return [];
        }
    }

    public function guardar($data) {
        $jsonString = json_encode($data);
        file_put_contents($this->urlArchivo, $jsonString);
    }

    public function guardarImagen($imagen)
    {
        $nombre_archivo = $_FILES[$imagen]['name'];
        $tipo_archivo = $_FILES[$imagen]['type'];
        $tamano_archivo = $_FILES[$imagen]['size'];
        $rutaDestino =  $this->urlArchivo . $nombre_archivo;
        if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000)))
        {
            echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .png o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
        }
        else
        {
            if (move_uploaded_file($_FILES[$imagen]['tmp_name'],  $rutaDestino))
            {
                   echo "El archivo ha sido cargado correctamente.";
            }
            else
            {
                   echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
        }
    }
}
?>