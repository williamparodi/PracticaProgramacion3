<?php
/*
Parte 9 - Ejercicios PDO
Aplicación Nº 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , crear
un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.*/

class Usuario
{
    private $_nombre;
    private $_apellido;
    private $_mail;
    private $_clave;
    private $_fechaDeRegistro;
    private $_localidad;

    public function __construct($nombre,$apellido,$clave = NULL,$mail = NULL,$_localidad =NULL)
    {
        if($nombre != NULL && $apellido != NULL)
        {
            $this->_nombre = $nombre;
            $this->_apellido = $apellido;
            $this->_fechaDeRegistro = date('d-m-y');
            if($clave != NULL && $mail != NULL && $_localidad != NULL)
            {
                $this->_clave = $clave;
                $this->_mail = $mail;
            }
            else
            {
                $this->_clave ="Sin clave";
                $this->_mail ="Sin mail";
                $this->_localidad = "Sin localidad";
            }
        }
    }

    public function GetId()
    {
        return $this->_id;
    }
    public function GetNombre()
    {
        return $this->_nombre;
    }

    public function GetApellido()
    {
        return $this->_nombre;
    }

    public function GetMail()
    {
        return $this->_mail;
    }

    public function GetLocalidad()
    {
        return $this->_localidad;
    }

    public function GetClave()
    {
        return $this->_clave;
    }

    public function GetFechaDeRegistro()
    {
        return $this->_fechaDeRegistro;
    }

    public function SetNombre($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function SetMail($mail)
    {
        $this->_mail = $mail;
    }

    public function SetFechaDeRegistro($fechaDeRegistro)
    {
        $this->_fechaDeRegistro = $fechaDeRegistro;
    }

    public function SetClave($clave)
    {
        $this->_clave = $clave;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }
    
    public static function EstableceConexion()
    {
        try
        {
            $conStr = "mysql:host=localhost; dbname=tp";
            $pdo = new PDO($conStr);
        }
        catch(PDOException $e)
        {
            echo "Error: no se pudo conectar". $e->getMessage();
        }
        return $pdo;
    }


    public static function AltaUsuario($usuario)
    {
        try
        {
            $pdo = self::EstableceConexion();

            $sentencia = $pdo->prepare("INSERT INTO usuario(id, nombre, apellido, clave, mail, fecha_de_registro, localidad"); 
            $sentencia->bindValue($usuario->GetNombre(),$usuario->GetApellido(),$usuario->GetClave(),
                                $usuario->GetFechaDeRegistro(),$usuario->GetLocalidad());
            $sentencia->execute();
        }
        catch(Exception $e)
        {
            echo "No se pudo agregar".$e->getMessage();
        }
    }
}

?>