<?php
/*
Aplicación Nº 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario*/

class Usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre,$clave=null,$mail=null)
    {
        if(is_string($nombre))
        {
            $this->_nombre = $nombre;
        }
        if($clave != NULL && $mail != NULL)
        {
            $this->_clave = $clave;
            $this->_mail = $mail;
        }
        else
        {
            echo "Error,al cargar datos";
        }
        
    }

    public function Equals($usuario)
    {
        $retorno = false;
        if($usuario != NULL)
        {
            if($this->_nombre == $usuario->_nombre && $this->_mail == $usuario->_mail)
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function MostarUsuario($usuario)
    {
        if($usuario != NULL)
        {
            echo "Nombre: $usuario->_nombre <br/>";
            echo "Clave: $usuario->_clave <br/>";
            echo "Mail: $usuario->_mail <br/>";
        }
    }

    public static function AltaUsuario($path,$usuario)
    {
        if($usuario != NULL)
        {
           if(!Usuario::VerificaUsuarioCargado($path,$usuario))
           {
                $file = fopen($path,"a");
                $data = array($usuario->_nombre,$usuario->_clave,$usuario->_mail);
                $linea = fputcsv($file,$data);
                fclose($file);
                if($linea >0)
                {
                    echo "Usuario Agregado al archivo<br/>";
                }
                else
                {
                    echo "Error al agregar el usuario al archivo<br/>";
                }
           }
           else
           {
                echo "El usuario ya esta en la base de datos,no se agrega<br/>";
           }
        }
    }

    public static function LeeUsuarios($path)
    {
        $arrayUsuarios = null;
        if(file_exists($path))
        {
            $file = fopen($path,"r");
            $arrayUsuarios = array();
            if($file !== false)
            {
                while(!feof($file))
                {
                    $data = fgetcsv($file,filesize($path));
                    if($data != false)
                    {
                        $nombre = $data[0];
                        $clave = $data[1];
                        $mail = $data[2];
                        $usuario = new Usuario($nombre,$clave,$mail);
                        array_push($arrayUsuarios,$usuario);
                    }
                }
            }
        }
        
        return $arrayUsuarios;
    }

    public static function VerificaUsuarioCargado($path,$usuario)
    {
        $retorno = false;
        if(file_exists($path))
        {
            $arrayUsuarios = Usuario::LeeUsuarios($path);
            if(count($arrayUsuarios) >0 && $usuario != null)
            {
                foreach($arrayUsuarios as $u)
                {
                    if($u->Equals($usuario))
                    {
                        $retorno = true;
                        break; 
                    }
                }
            }
        }
        
        return $retorno;
    }

    public static function MuestraLista($usuarios)
    {
        echo "<ul>";
        foreach($usuarios as $usuario)
        {
            echo "<li> Nombre: $usuario->_nombre </li>";
            echo "<li> Clave: $usuario->_clave </li>";
            echo "<li> Mail: $usuario->_mail </li>";
        }
        echo "</ul>";
    }
}


?>