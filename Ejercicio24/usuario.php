<?php
/*
Aplicación No 24 ( Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,etc.),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista.
Hacer los métodos necesarios en la clase */

class Usuario
{
    private $_nombre;
    private $_mail;
    private $_id;
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

    public static function RetornaLista($nombreLista)
    {
        $retorno = false;

        if($nombreLista == "usuarios")
        {   
            $retorno = true;
        }

        return $retorno;
    }


    public static function LeeJson()
    {
        $arrayUsuario = array(); 
        $arrayJson = array();
        $fileJson = __DIR__.'/registro.json';

        if(file_exists($fileJson))
        {
            $arrayUsuarios =  file_get_contents($fileJson);
            $arrayJson = json_decode($arrayUsuarios, true); 
    
            foreach($arrayJson as $usuario)
            {
                $usuarioAgregar = new Usuario("Sin Nombre");
                $usuarioAgregar->SetId($usuario['id']);
                $usuarioAgregar->SetNombre($usuario["nombre"]);
                $usuarioAgregar->SetMail($usuario["mail"]);
                $usuarioAgregar->SetClave($usuario["clave"]);
                $usuarioAgregar->SetFechaDeRegistro($usuario["fechaRegistro"]);
                array_push($arrayUsuario,$usuarioAgregar);
                
            }     
        }
        else
        {
            echo "No se concontro el archivo <br/>";
        }

        return $arrayUsuario;
    }

    public static function MostrarListaUsuarios()
    {
        $arrayUsuarios = Usuario::LeeJson();

        if($arrayUsuarios != NULL && count($arrayUsuarios) >0)
        {
            /*
            foreach($arrayUsuarios as $usuario)
            {
                $arrayUsuario= array($usuario->GetId(),
                                $usuario->GetNombre(),
                                $usuario->GetMail(),
                                $usuario->GetClave(),
                                $usuario->GetFechaDeRegistro());

                list($id,$nombre,$mail,$clave,$fecha) = $arrayUsuario;
                
                echo "Id: $id <br/>". 
                "Nombre: $nombre <br/>". 
                "Mail : $mail <br/>". 
                "Clave :$clave <br/>". 
                "Fecha de registro : $fecha <br/>";
                echo "<br/>";
            
            } Ver cual de las dos usar */
            $lista = "<ul>\n";
            foreach ($arrayUsuarios as $usuario)
            {
              $lista .= "<li>ID: " . $usuario->getId() . 
              " - Nombre: " . $usuario->getNombre() . 
              " - Mail: " . $usuario->getMail() . "</li>\n";
            }
            $lista .= "</ul>\n";
          
            return $lista;
        }
    }
      
}


?>