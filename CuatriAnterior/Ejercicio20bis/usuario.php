<?php
/*
Aplicación Nº 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario*/

class Usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre,$clave= "Sin clave",$mail = "Sin mail")
    {
        if($nombre != NULL)
        {
            $this->_nombre = $nombre;
            if($clave != NULL)
            {
                $this->_clave = $clave;
                $this->_mail = $mail;
            }
        }        
    }

    public function Equals($usuario1,$usuario2)
    {
        $retorno = false;
        if($usuario1 != NULL && $usuario2 != NULL)
        {
            if($usuario1->_mail == $usuario2->_mail)
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function AltaUsuario($usuario)
    {
        if($usuario != NULL)
        {
            $archivo = fopen("registro.csv","a");
            $unUsuario = $usuario->_nombre. "," . $usuario->_clave. "," .
             $usuario->_mail. ","."\n";
            fwrite($archivo,$unUsuario);
            fclose($archivo);
        }
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
                    $nombre = trim($datos[0]);
                    $clave = trim($datos[1]);
                    $mail = trim($datos[2]);
                    $usuario = new Usuario($nombre,$clave,$mail);
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

    public static function AgregaUsuario($usuario)
    {
        $retorno = true;
        if($usuario != NULL)
        {
           
                $arrayUsuarios = Usuario::LeeRegistro();
                foreach($arrayUsuarios as $valor)
                {
                    if($valor->Equals($valor,$usuario))
                    {
                        $retorno = false;
                        break;
                    }
                }
                if($retorno)
                {
                    Usuario::AltaUsuario($usuario);
                }
            
        }
        return $retorno;
    }
}
?>