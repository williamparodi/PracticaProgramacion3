<?php

use Usuario as GlobalUsuario;

class Usuario
{
    private $_id;
    private $_nombre;
    private $_mail;
    private $_clave;
    private $_fechaDeRegistro;

    public function __construct($nombre,$clave = NULL,$mail = NULL)
    {
        if($nombre != NULL)
        {
            $this->_nombre = $nombre;
            $this->_id = rand(1,1000);
            $this->_fechaDeRegistro = date('d-m-y');
            if($clave != NULL && $mail != NULL)
            {
                $this->_clave = $clave;
                $this->_mail = $mail;
            }
            else
            {
                $this->_clave ="Sin clave";
                $this->_mail ="Sin mail";
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

    public function GetMail()
    {
        return $this->_mail;
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

    public static function LeeJson()
    {
        $fileJson = __DIR__."/registro.json";
        $arrayUsuarios = array();

        if(file_exists($fileJson))
        {   
            $arrayCodificado = file_get_contents($fileJson);
            $arrayDecodificado = json_decode($arrayCodificado,true);

            foreach($arrayDecodificado as $usuario)
            {
                $usuarioNuevo = new Usuario(
                $usuario["nombre"],
                $usuario["mail"],
                $usuario["clave"],
                $usuario["fechaRegistro"]);
                $usuarioNuevo->SetId($usuario["id"]);
                array_push($arrayUsuarios,$usuarioNuevo);
            }
            
        }
        return $arrayUsuarios;
    }

    public function AltaUsuario($usuario)
    {
        $retorno = false;
        $arrayUsuarios = array(); 
        $fileJson = __DIR__.'/Usuario/Fotos/registro.json';

        if($usuario != NULL)
        {
            $usuario = array(
                "id" => $this->_id,
                "nombre" => $this->_nombre,
                "mail" => $this->_mail,
                "clave" => $this->_clave,
                "fechaRegistro" => $this->_fechaDeRegistro
            );
            //Guardo el usuario en un array 
            array_push($arrayUsuarios,$usuario);
           
            if(file_exists($fileJson))
            {
                //Contenido actual del json  
                $usuariosJson = file_get_contents("Usuario/Fotos/registro.json");
                //Decodifico el archivo a json en un array 
                $arrayJson = json_decode($usuariosJson, true);
                //Agrego al array con el usuario agregado al array decodificado
                array_push($arrayJson,$arrayUsuarios);
                //Codifico el array a formato Json
                $usuariosJson = json_encode($arrayJson, JSON_PRETTY_PRINT); 
            }
            else
            {
                //Si no hay archivo codifico el array directo a json 
                $usuariosJson = json_encode($arrayUsuarios, JSON_PRETTY_PRINT);
            }
            //Pongo el contenido codificado en el json.
            file_put_contents("Usuario/Fotos/registro.json",$usuariosJson);
            $retorno = true;
        }

        return $retorno;
    }
}


?>
