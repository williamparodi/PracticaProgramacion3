<?php
// Comienzo de la sesión
session_start();
//session_destroy();
if(isset($_SESSION["usuario"])){
    echo $_SESSION["usuario"];
} else {
    // Guardar datos de sesión
    $_SESSION["usuario"] = "Franco";
}

?>