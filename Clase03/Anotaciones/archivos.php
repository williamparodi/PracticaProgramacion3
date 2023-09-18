<?php
//fgets retorna menos - byte o false lee una linea o sea hasta el \n
//$file = fgets($archivo);
//feof($archivo) para saber si el puntero esta al final 
//ejemplo
/*while(!feof($archivo))
{
    $file = fgets($archivo);
    //chequar las lineas vacias
    if($lectura !== false)
    {
        echo $lectura;
    }
    else
    {
        echo "Error";
    }

}
fclose($archivo);*/
//fwrite() o fputs()
//retorna  cantidad de bytes que se escribieron o  false
//copy("libro.txt","/carpetaDestino);
//unlink("carpeta/archivo.txt");// borrar archivo

//Envio de datos
//http es comunicacion entre clientes y servidores
//http funciona como un protocolo de pedido-respuesta entre cliente y servidor 
//Un navegador web puede ser el cliente y una app sobre una pc que aloja un sitio web puede ser el servidor
//es una comunicacion sincrona, se envia el server procesa y se devuelve una respuesta, se hace sobre el protocolo php
//la peticion es el request y el servidor response, el servidor tambien puede andar una peticion a otro sever para crear la respuesta
//Hyper texto con formato enriquesido y lo hace con un protocolo o formato establecido
//ese protocolo tiene la caracteristica de que las peticiones y respuestas van con ese proto http
//En http lo que se envia esta sin seguridad, por https esta cerrado y con seguridad
//Ip internet protocol identifica una pc en una red, el domninio es como un nombre de fantasia.
//MEtodos o VERBOS : 
//GET , POST PUT y DELETE
/*--------GET es para obetener un recurso/ lectura----------
-------EL navegador solo puede hacer peticiones del tipo GET---------
se le puede pasar parametros por medio de la url un peticion 
Ejempo : localhost/index.php?nombre=franco
Pero tiene un limite, se va atruncar despues de X caracteres. 
y permite guardarse en el historial cosa que el post no.
--------------------------------------------------------- 
POST la creacion de algo del lado del servidor o alterar un recurso
no se almacena en cache, no tiene longitud de datos. Y tiene un body y en este puede viajar un clave valor
y no va a ser visible para el navegador. Es mas seguro y no viaja en la URL. 
No permanece en el historial.
----------------------------
Put altera tambien 
Delete borra un recurso
//status code un standar numerico identifica como salio y de que lado esta el error

Manejo de formularios
Info se manda por formulario
Tanto get o post crean  un array asociativo que contienen clave-valor
claves son los nombres(atributos name) de los controles del formulario y los valores son la entradad de datos
del usuario. 
PHP utliza las super GLobales (estan al alcance de todos, alto nivel) $_GET,$_POST y $REQUEST parar recolectar datos del 
form. 
Esos arrays asociativos los toma el GET o el POST, siempre se ejecuta mi script sea post o get, 
puede pensar si viene get hago una cosa u otra
el Request junta el get y el post , por las dudas
$_COOKIE

$_GET['nombre'];
var_dump($_SERVER['REQUEST_METHOD'];


POSTMAN: 
Elegir metodo Get , post, put o delete 
Te tira el Dato crudo 
en pretty te lo acomoda en raw es el verdadero dato y en el Preview se ve como en el html 

si es post o get si lo mandas por url te lo guarda igual 
La linea azul del postman separa request (arriba) y abajo la response

Param GET 
BODY va lo post o sea nombre, altura y demas 

lo que esta en el body de la request lo pido en el codigo con POST

isset()

EN post y va por pestaña body y form-data
 enviroments puedo setear variables en el url y asi 

?>