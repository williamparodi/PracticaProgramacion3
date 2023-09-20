<?php
//ejemplo
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        switch ($_GET['accion']){
            case 'leer':
                echo 'leer archivo';
                // Ejemplo de in
                include 'Usuario.php';
                //Usuario::LeerUsuarios();
                break;
            case 'buscar':
                echo 'buscar archivo';
                break;
        }
        break;
    case 'POST':
        echo 'POST';
        break;
    default:
        echo 'Verbo no permitido';
        break;
}

?>