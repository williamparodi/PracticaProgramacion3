export function validarDatosPersona(formulario)
{
    let retorno = false;

    if(validarNumeros(formulario.edad) 
       && validarLetras(formulario.nombre)
       && validarLetras(formulario.apellido))
    {
        retorno = true;
    }

    return retorno;
}

export function validaCliente(formulario)
{
    let retorno = false;
    if(validarDatosPersona(formulario))
    {
        if(validarNumeros(formulario.compras)) //&& validarNumeros(formulario.telefono))
        {
            retorno = true;
        }
    }
    return retorno;
}

export function validoEmpleado(formulario)
{
    let retorno = false;
    if(validarDatosPersona(formulario))
    {
        if(validarNumeros(formulario.ventas) && validarNumeros(formulario.sueldo))
        {
            retorno = true;
        }
    }
    return retorno;
}

export function validarNumeros(numero)
{
    let retorno = false;
    if(!isNaN(numero)&& numero >0)
    {
        retorno = true;
    }
    else
    {
        alert("Solo numeros validos","mensaje-error");
    }
    return retorno;
}

export function validarLetras(palabras)
{
    let retorno = false;
    if(palabras.length > 0 && palabras.length < 50)
    {
        retorno = true;
    }
    else
    {
        alert("Se paso con la cantidad de palabras","mensaje-error");
    }
    return retorno;
}
