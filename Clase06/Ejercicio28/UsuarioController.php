<?php

require_once 'Usuario.php';

class UsuarioController
{
    public function insertarUsuario($nombre,$apellido,$clave,$mail,$localidad) 
    {   
        $nuevoUsuario = new Usuario1();
        $nuevoUsuario->_nombre = $nombre;
        $nuevoUsuario->_apellido = $apellido;
        $nuevoUsuario->_clave = $clave;
        $nuevoUsuario->_mail = $mail;
        $nuevoUsuario->_localidad =  $localidad;
        //fecha recodar siempre usar este formato para base de datos 
        $fechaRegistro = (new DateTime())->format('Y-m-d');
        $nuevoUsuario->_fecha_de_registro = $fechaRegistro;
        return $nuevoUsuario->InsertarElUsuario();
    }

    public function listarUsuarios() {
        return Usuario1::TraerTodosLosUsuarios();
    }


}


?>