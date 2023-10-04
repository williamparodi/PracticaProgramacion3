<?php

require_once "./Usuario.php";

class UsuarioController
{
    public function insertarUsuario($nombre,$apellido,$clave,$mail,$fecha_de_registro) 
    {   
        $nuevoUsuario = new Usuario();
        $nuevoUsuario->_nombre = $nombre;
        $nuevoUsuario->_apellido = $apellido;
        $nuevoUsuario->_clave = $clave;
        $nuevoUsuario->_mail = $mail;
        $nuevoUsuario->_fecha_de_registro = new DateTime();
        return $nuevoUsuario->InsertarElUsuario()
    }
}


?>