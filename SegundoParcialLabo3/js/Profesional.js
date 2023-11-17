
import {Persona} from "./Persona.js";
export class Profesional extends Persona
{
    static idAutoIncrementalProfesional = parseInt(localStorage.getItem("idAutoIncrementalProfesional"))||1000;
    constructor(id,nombre,apellido,edad,titulo,facultad,añoGraduacion)
    {
        super(id,nombre,apellido,edad);
        this.id = Profesional.generaNuevoId();
        this.titulo = titulo;
        this.añoGraduacion = añoGraduacion;
        this.facultad = facultad;
    }


    setID(id) 
    {
        this.id = id;
    }

    static generaNuevoId()
    {
        const nuevoId = ++Profesional.idAutoIncrementalProfesional;
        localStorage.setItem("idAutoIncrementalProfesional",nuevoId.toString());
        return nuevoId;    
    }

}