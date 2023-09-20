<?php
/*
Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.*/ 

class Usuario
{
    private $_id;
    private $_nombre;
    private $_clave;
    private $_mail;
    private $_fechaDeRegistro;

    public function __construct($nombre,$clave,$mail="Sin mail")
    {
        if(is_string($nombre) && $nombre != NULL)
        {
            $this->_nombre = $nombre;
        }
        if($clave != NULL)
        {
            $this->_clave = $clave;
        }
        $this->_mail = $mail;
        $this->_id = rand(1,10000);
        $this->_fechaDeRegistro = new DateTime();
    }

    public static function GuardaDatosUsuario($usuario)
    {
        if($usuario != NULL)
        {
            $destino =  "Usuarios/".$_FILES["archivo"]["name"];
            $usuario_Json = json_encode($usuario);
            
        }
    }



}
?>