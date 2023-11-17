//import {ejecutarModPersona,obtenerIdPersonaSeleccionada,obtenerPersonaPorId,modificarPersona, modificacion} from "./scrips.js";

export const crearTabla = (data) => {
    if (!Array.isArray(data)) return null;
    const table = document.createElement("table");
    const headers = ["id", "nombre", "apellido", "edad", "equipo", "posicion", "cantidadGoles", "titulo", "facultad",
    "añoGraduacion","modificar", "eliminar"];
    table.appendChild(crearCabecera(headers));
    table.appendChild(crearCuerpo(data, headers));
    return table;
  }
  
  const crearCabecera = (headers) => {
    const thead = document.createElement("thead");
    const tr = document.createElement("tr");
    headers.forEach((valor) => {
      const th = document.createElement("th");
      th.textContent = valor;
      tr.appendChild(th);
    });
    thead.appendChild(tr);
    return thead;
  }
  
  const crearCuerpo = (data, headers) => {
    if (!Array.isArray(headers)) return null;
  
    const tbody = document.createElement("tbody");
  
    data.forEach((persona) => {
      if (obtenerAtributos(data).some((atributo) => persona.hasOwnProperty(atributo))) 
      {
        const tr = document.createElement("tr");
        headers.forEach((header) => {
          const cell = document.createElement("td");
          cell.classList.add(header.toLowerCase());
          if (header === "modificar") 
          {
            const modificarButton = document.createElement("button");
            modificarButton.textContent = "Modificar";
            modificarButton.id = "modificar";
            /*
            modificarButton.addEventListener("click", (event) => 
            {
              const fila = modificarButton.closest("tr");
              console.log("entre en mod");
              const personaSelecionada = obtenerPersonaPorId(obtenerIdPersonaSeleccionada(fila));
              console.log("Persona:" + personaSelecionada);
                if(personaSelecionada.hasOwnProperty("titulo"))
                {
                  // Carga los datos en el formulario de ABM
                  cargarFormEmpleados(personaSelecionada);
                  modificacion(event);
                  console.log("Entre en cargaEmpleados");
                  
                }
                else if (personaSelecionada.hasOwnProperty("compras"))
                {
                  cargarFormClientes(personaSelecionada);
                  modificacion(event);
                  console.log("Entre en cargaClientes");
                }
            });*/
            cell.appendChild(modificarButton);
          } 
          else if (header === "eliminar") 
          {
            const eliminarButton = document.createElement("button");
            eliminarButton.textContent = "Eliminar";
            // Agrega el evento para manejar la eliminación aquí
            eliminarButton.addEventListener("click", () => {
              // Lógica para eliminar la persona
            });
            cell.appendChild(eliminarButton);
          } 
          else 
          {
            if (persona[header]) 
            {
              cell.textContent = persona[header];
            } 
            else 
            {
              cell.textContent = "N/A";
            }
          }
          tr.appendChild(cell);
        });
        tbody.appendChild(tr);
      }
    });
  
    return tbody;
  }

function Vaciar(elemento){
    while(elemento.hasChildNodes())
    {
        elemento.removeChild(elemento.lastChild);
    }
}

export const actualizarTabla =(contenedor,data)=>
{
    while(contenedor.hasChildNodes())
    {
        contenedor.removeChild(contenedor.firstElementChild);
    }
    contenedor.appendChild(crearTabla(data));
    
}

function obtenerAtributos(data) 
{
    const atributos = ["id", "nombre", "apellido", "edad", "equipo", "posicion", "cantidadGoles", "titulo", "facultad",
    "añoGraduacion","modificar", "eliminar"];
    return atributos.filter(atributo => data.some(persona => persona.hasOwnProperty(atributo)));
}



