<?php

class Usuario
{
    private $_mail;
    private $_clave;

    public function __construct($mail,$clave = "Sin Clave")
    {
        if($mail != NULL)
        {
            $this->_mail = $mail;
            if($clave != NULL)
            {
                $this->_clave = $clave;
            }
        }
    }

    public static function VerificaUsuario($usuario)
    {  
        $arrayUsuarios = Usuario::LeeRegistro();
        $retorno = "Usuario no registrado";
        foreach($arrayUsuarios as $valor)
        {
            if($valor->_mail == $usuario->_mail && $valor->_clave == $usuario->_clave)
            {
                $retorno = "Verificado <br/>";
                break;
            }
            else if($valor->_mail == $usuario->_mail && $valor->_clave != $usuario->_clave)
            {
                $retorno = "Error en los datos <br/>";
                break;
            }
        }
        return $retorno;
    }

    public static function LeeRegistro()
    {
        $usuarios = array();
        if(file_exists("registro.csv"))
        {
            $archivo = fopen("registro.csv","r");
            while(!feof($archivo))
            {
                $unUsuario = fgets($archivo);
                if($unUsuario)
                {
                    //Marca la separacion y lo guarda en datos(un array)
                    $datos = explode(",",$unUsuario);//divide por comas
                    $mail = trim($datos[0]);
                    $clave = trim($datos[1]);
                    $usuario = new Usuario($mail,$clave);
                    array_push($usuarios,$usuario);
                }
            }
        }
        else
        {
            $archivo = fopen("registro.csv","x");
        }
        fclose($archivo); 
        return $usuarios;
    }

    public static function MuestraLista($usuarios)
    {
        echo "<ul>";
        foreach($usuarios as $usuario)
        {
            echo "<li> Mail: $usuario->_mail </li>";
            echo "<li> Clave: $usuario->_clave </li>";
        }
        echo "</ul>";
    }

}


?>
