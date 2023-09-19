<?php
/*
Aplicación Nº 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario*/


class Usuario
{
    private $_clave;
    private $_mail;

    public function __construct($mail,$clave="Sin clave")
    {
        if($mail != NULL)
        {
            $this->_mail = $mail;
        }
        else
        {
            echo "Error,al cargar datos";
        }
        $this->_clave = $clave;
    }

    public function Equals($usuario)
    {
        $retorno = false;
        if($usuario != NULL)
        {
            if($this->_clave == $usuario->_clave && $this->_mail == $usuario->_mail)
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
            echo "Mail: $usuario->_mail <br/>";
            echo "Clave: $usuario->_clave <br/>";
        }
    }

    public static function VerificaUsuario($arrayUsuarios,$usuario)
    {
        $flag = false;
        if($usuario != NULL && $arrayUsuarios != NULL)
        {
            foreach($arrayUsuarios as $u)
            {
                if($u->Equals($usuario))
                {
                    echo "Verificado</br>";
                    $flag = true;
                    break;
                }
                else if($usuario->_mail == $u->_mail && $usuario->_clave != $u->_clave)
                {
                    echo "Error en los datos <br/>";
                    $flag = true;
                    break;
                }
                else if($usuario->_mail != $u->_mail && $usuario->_clave == $u->_clave)
                {
                    echo "Usuario no registrado <br/>";
                    $flag = true;
                    break;
                }
            }

            if(!$flag)
            {
                echo "Debe registrarse primero<br/>";
            }
        }
    }

    public static function LogueaUsuario($path,$usuario)
    {
        $arrayUsuarios = array();
        if($usuario != NULL)
        {
            if(file_exists($path))
            {
                $arrayUsuarios = Usuario::LeeUsuarios($path);
                Usuario::VerificaUsuario($arrayUsuarios,$usuario);
            }
        }
    }
    
    public static function AltaUsuario($path,$usuario)
    {
        if($usuario != NULL)
        {
           if(!Usuario::VerificaUsuarioCargado($path,$usuario))
           {
                $file = fopen($path,"a");
                $data = array($usuario->_mail,$usuario->_clave);
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
                        $mail = $data[0];
                        $clave = $data[1];
                        $usuario = new Usuario($mail,$clave);
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

}

?>