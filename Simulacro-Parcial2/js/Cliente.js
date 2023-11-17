import {Persona} from "./Persona.js";
export class Cliente extends Persona
{
    static idAutoIncrementalCliente = parseInt(localStorage.getItem("idAutoIncrementalCliente"))||5000;
    constructor(id,nombre,apellido,edad,compras,telefono)
    {
        super(id,nombre,apellido,edad)
        this.id = Cliente.generaNuevoId();
        this.compras = compras;
        this.telefono = telefono;
    }

    get Compras()
    {
        return this.Compras;
    }

    set Compras(compras)
    {
        if(compras != null && compras > 0)
        {
            this.compras = compras;
        }
        else
        {
            alert("Datos de compra incorrectos");
        }
    }

    get Telefono()
    {
        return this.Telefono;
    }

    set Telefono(telefono)
    {
        if(telefono != null)
        {
            this.telefono = telefono;
        }
        else
        {
            alert("Datos de telefono incorrectos");
        }
    }

    setID(id) 
    {
        this.id = id;
    }
    
    static generaNuevoId()
    {
        const nuevoId = ++Cliente.idAutoIncrementalCliente;
        localStorage.setItem("idAutoIncrementalCliente",nuevoId.toString());
        return nuevoId;    
    }

    toSting()
    {
        return `{id:"${this.id}",nombre:"${this.nombre}", 
                apellido: "${this.apellido}",edad:"${this.edad}",
                compras:"${this.compras}",telefono: "${this.telefono}"}`; 
    }
    /*
    toJson() 
    {
      return JSON.stringify(this);  
    } */

    creaArrayClientes(array)
    {
        if(array != null)
        {
            arrayClientes =[];
            array.forEach(element => {
                const cliente = new Cliente();
                cliente.id = element.id;
                cliente.nombre = element.nombre;
                cliente.apellido = element.apellido;
                cliente.Compras = element.compras;
                cliente.Telefono = element.telefono;
                arrayClientes.push(cliente);
            });

            return arrayClientes;
        }    
    }
}