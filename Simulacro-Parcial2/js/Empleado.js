
import {Persona} from "./Persona.js";
export class Empleado extends Persona
{
    static idAutoIncrementalEmpleado = parseInt(localStorage.getItem("idAutoIncrementalEmpleado"))||1000;
    constructor(id,nombre,apellido,edad,sueldo,ventas)
    {
        super(id,nombre,apellido,edad);
        this.id = Empleado.generaNuevoId();
        this.sueldo = sueldo;
        this.ventas = ventas;
    }

    get Sueldo()
    {
        return this.sueldo;
    }

    get Ventas()
    {
        return this.ventas;
    }

    set Sueldo(sueldo)
    {
        if(sueldo != null && sueldo > 0)
        {
            this.sueldo = sueldo;
        }
        else
        {
            alert("Error,datos de sueldo erroneos");
        }
    }

    set Ventas(ventas)
    {
        if(ventas != null && ventas > 0)
        {
            this.ventas = ventas;
        }
        else
        {
            alert("Error,datos de ventas erroneos");
        }
    }

    setID(id) 
    {
        this.id = id;
    }

    static generaNuevoId()
    {
        const nuevoId = ++Empleado.idAutoIncrementalEmpleado;
        localStorage.setItem("idAutoIncrementalEmpleado",nuevoId.toString());
        return nuevoId;    
    }

    /*
    toJSON()
    {
        return JSON.stringify(this);
    }*/
}