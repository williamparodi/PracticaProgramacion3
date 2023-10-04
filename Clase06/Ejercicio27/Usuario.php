<?php
class usuario
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
        return "Usuario: " . $this->_nombre ."<br>"
        .$this->_apellido."<br>"
        .$this->_clave ."<br>"
        .$this->_mail ."<br>"
        .$this->_localidad ."<br>"
        .$this->_fecha_de_registro."<br>";
    }

    public function InsertarElUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (id,nombre,apellido,clave,mail,localidad,fecha_de_registro)
        values('$this->_nombre','$this->_apellido','$this->_clave','$this->_mail','$this->_localidad','$this->_fecha_de_registro')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    



}

?>