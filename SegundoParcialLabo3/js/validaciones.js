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

export function validaFutbolista(formulario)
{
    let retorno = false;
    if(validarDatosPersona(formulario))
    {
        if(validarNumeros(formulario.cantidadGoles) && validarLetras(formulario.equipo) 
        && validarLetras(formulario.posicion))
        {
            retorno = true;
        }
    }
    return retorno;
}

export function validaProfesional(formulario)
{
    let retorno = false;
    if(validarDatosPersona(formulario))
    {
        if(validarNumeros(formulario.añoGraduacion) && formulario.añoGraduacion > 1950 && validarLetras(formulario.titulo)
        && validarLetras(formulario.facultad))
        {
            retorno = true;
        }
    }
    return retorno;
}

export function validarNumeros(numero)
{
    let retorno = false;
    if(!isNaN(numero)&& numero >=0 && numero != null)
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
    if(palabras.length > 0 && palabras.length < 50 && palabras !== null)
    {
        retorno = true;
    }
    else
    {
        alert("Se paso con la cantidad de palabras","mensaje-error");
    }
    return retorno;
}
