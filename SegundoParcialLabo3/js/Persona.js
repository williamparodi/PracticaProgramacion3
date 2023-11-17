export class Persona
{
    constructor(id,nombre,apellido,edad)
    {
        if(id != null && nombre != null && apellido != null && edad)
        {
            this.id = id;
            this.nombre = nombre;
            this.apellido = apellido;
            this.edad = edad;
        }
    }

    get Edad()
    {
        return this.edad;
    }

    get Nombre()
    {
        return this.nombre;
    }

    get Apellido()
    {
        return this.apellido;
    }
    
    set Edad(edad)
    {
        if(validaEdad(edad))
        {
            this.edad = edad;
        }
        else
        {
            alert("Edad invalida");
        }
    }

    validaEdad(edad)
    {
        retorno = false;
        if(!isNaN(edad)  && edad > 15)
        {
            return retorno;
        }
    }

    

}