<?php

    if( isset( $_COOKIE['prueba']) )
    {
        echo "<p>La cookie está creada</p>";
        echo $_COOKIE["prueba"];//veo si esta seteada
    }
    else
    {
        echo "<p>La cookie no existe, la creamos</p>";
        // Crea una Cookie con un tiempo de vida de 2 minutos
         setcookie("prueba", true, time() + (60*2) );
    }

?>