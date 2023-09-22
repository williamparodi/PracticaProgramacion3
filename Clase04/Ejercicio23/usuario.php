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
        $this->_fechaDeRegistro = date('d-m-y');
    }

    public static function GuardaDatosUsuario($usuarios)
    {
        $retorno = false;
        if ($usuarios != NULL) 
        {
            $carpeta_destino =  "Usuarios/";
            $nombre_archivo = "usuarios.json";
            $destino = $carpeta_destino . $nombre_archivo;
            $arrayUsuarios = array();
            foreach($usuarios as $u)
            {
                $usuarioAsc = get_object_vars($u);
                array_push($arrayUsuarios, $usuarioAsc);
            }

            $json = json_encode($arrayUsuarios, JSON_PRETTY_PRINT);
            $archivo = file_put_contents($destino, $json);

            if ($archivo) 
            {
                $retorno = true;
                echo "Usuario añadido <br/>";
            }
        }

        return $retorno;
    }

    public static function LeeDatosUsuarios()
    {
        $carpeta_destino =  "Usuarios/";
        $nombre_archivo = "usuarios.json";
        $destino = $carpeta_destino . $nombre_archivo;
        $arrayUsuarios = null;

        if(file_exists($destino))
        {
            $arrayUsuarios = array();
            $json = file_get_contents($destino);
            $arrayUsuariosJson = json_decode($json,true);
            foreach($arrayUsuariosJson as $usuario)
            {
                $usuarioAgregar = new Usuario($usuario['_nombre'],$usuario['_clave'],$usuario['_mail']);
                $usuarioAgregar->_id = $usuario["_id"];
                $usuarioAgregar->_fechaDeRegistro = $usuario["_fechaDeRegistro"];
                array_push($arrayUsuarios,$usuarioAgregar);
            }
        }

        return $arrayUsuarios;
    }

    public static function SubeImagen($nombre)
    {
        $carpeta_destino =  "Usuarios/Fotos/";
      
        $destino = $carpeta_destino . $nombre;

        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) 
        {
            echo "<br/>El archivo : ". basename( $_FILES["archivo"]["name"]). " se subio exitosamente.";
        } 
        else 
        {
            echo "<br/>Error al subir el archivo";
        }
         
    }

    public static function AltaUsuario($usuario)
    {
       $array = Usuario::LeeDatosUsuarios();
        
       if($array != NULL)
       {
            array_push($array,$usuario);
       }
       else
       {
            $array = array();
            array_push($array,$usuario);
       }

       Usuario::GuardaDatosUsuario($array);

    }
}
?>