import {Persona} from "./Persona.js";
export class Futbolista extends Persona
{
    static idAutoIncrementalFutbolista = parseInt(localStorage.getItem("idAutoIncrementalFutbolista"))||5000;
    constructor(id,nombre,apellido,edad,equipo,posicion,cantidadGoles)
    {
        super(id,nombre,apellido,edad)
        this.id = Futbolista.generaNuevoId();
        this.posicion = posicion;
        this.cantidadGoles = cantidadGoles;
        this.equipo = equipo;
    }

    setID(id) 
    {
        this.id = id;
    }
    
    static generaNuevoId()
    {
        const nuevoId = ++Futbolista.idAutoIncrementalFutbolista;
        localStorage.setItem("idAutoIncrementalFutbolista",nuevoId.toString());
        return nuevoId;    
    }

    toSting()
    {
        return `{id:"${this.id}",nombre:"${this.nombre}", 
                apellido: "${this.apellido}",edad:"${this.edad}",equipo:"${this.equipo}",
                posicion:"${this.posicion}",cantidadGoles: "${this.cantidadGoles}"}`; 
    }
   
    creaArrayFutbolistas(array)
    {
        if(array != null)
        {
            arrayFutbolistas =[];
            array.forEach(element => {
                const Futbolista = new Futbolista();
                Futbolista.id = element.id;
                Futbolista.nombre = element.nombre;
                Futbolista.apellido = element.apellido;
                Futbolista.equipo = element.equipo
                Futbolista.posicion = element.posicion;
                Futbolista.cantidadGoles = element.cantidadGoles;
                arrayFutbolistas.push(Futbolista);
            });

            return arrayFutbolistas;
        }    
    }
}