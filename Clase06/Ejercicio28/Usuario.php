<?php
require_once './db/AccesoDatos.php';

class Usuario1
{
    public $_id;
    public $_nombre;
    public $_apellido;
    public $_clave;
    public $_mail;
    public $_localidad;
    public $_fecha_de_registro;

    public function MostarUsuario()
    {
        return "Usuario:" . $this->_nombre ." "
        .$this->_apellido." "
        .$this->_clave ." "
        .$this->_mail ." "
        .$this->_localidad ." "
        .$this->_fecha_de_registro;
    }

    public function InsertarElUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre, apellido, clave, mail, localidad, fecha_de_registro)
        values('$this->_nombre', '$this->_apellido', '$this->_clave', '$this->_mail', '$this->_localidad', '$this->_fecha_de_registro')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    
    public function InsertarElUsuarioParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre, apellido, clave, mail, localidad, fecha_de_registro)
        values(:nombre, :apellido, :clave, :mail, :localidad, :fecha_de_registro)");
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->_localidad, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_registro', $this->_fecha_de_registro, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodosLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, apellido, clave, mail, localidad, fecha_de_registro FROM usuario");
        $consulta->execute();
        //return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario1");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>