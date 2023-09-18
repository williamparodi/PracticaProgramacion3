<?php
class Usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre,$clave="",$mail="")
    {
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        $this->_mail = $mail;
    }

    
}
?>