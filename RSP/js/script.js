
import { Vehiculo } from "./Vehiculo.js";
import { Terrestre } from "./Terrestre.js";
import { Aereo } from "./Aereo.js";
import {validaAereo,validaTerrestre} from "./validaciones.js"
let lista = {};
let id = null;
let vehiculoAModificar;
let aceptarAbmCallback;

const url = "http://localhost/RSP/vehiculoAereoTerrestre.php";
const seccionTabla = document.getElementById("tabla");
const dropdownAbm = document.getElementById("dropAbm");
const aceptarDatosButton = document.getElementById("agregar");
const aceptarAbmButton = document.getElementById('aceptarAbm');
const formulario = document.forms[0];
const formAbm = document.forms[1];
const spinner = document.getElementById("spinner");
spinner.style.display = "block";

async function cargaPost() {
    try 
    {
        muestraFormDatos();
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
        });
        if (response.ok) 
        {
            const data = await response.json();
            if (data.length) 
            {
                actualizarTabla(seccionTabla, data);
            } 
            else 
            {
                localStorage.setItem("lista", JSON.stringify(data));
                console.warn('La lista obtenida del servidor está vacía.');
            }
            localStorage.setItem("lista", JSON.stringify(data));
        } else {
            // Lógica para manejar una respuesta no exitosa
            console.error('Error en la respuesta de la API:', response.statusText);
        }
    } 
    catch (error)
    {
        // Manejar errores de la solicitud
        console.error('Error al realizar la solicitud:', error.message);
    }
    spinner.style.display = "none";
};

cargaPost();

//Alta
async function altaXhttp(objeto,callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4)
        {
            if(xhttp.status == 200) 
            {
                let resultado = JSON.parse(xhttp.responseText);;
                id = resultado.id;
                callback(null, resultado);
            } 
            else 
            {
                alert("error:", JSON.parse(xhttp.responseText));
                callback(new Error("Error en la solicitud"));
            }
        }
    };
    xhttp.open("PUT", url, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(objeto));
}


async function altaVehiculo(nuevoVehiculo) 
{
  spinner.style.display = "block";
  if (nuevoVehiculo != null) 
  {
    altaXhttp(nuevoVehiculo,(error,resultado)=> 
    {
        if (!error) 
        {
            nuevoVehiculo.setID(resultado.id);
            console.log(nuevoVehiculo);
            const lista = JSON.parse(localStorage.getItem("lista")) || [];
            lista.push(nuevoVehiculo);
            localStorage.setItem("lista",JSON.stringify(lista));
            actualizarTabla(seccionTabla, lista);
            formAbm.reset();
        } 
        else
        {
            alert("Error en alta:",error);
        }
        spinner.style.display = "none";
        muestraFormDatos();
    });
  }
}


function handlerAceptar(event) 
{
  event.preventDefault();
  const txtId = document.getElementById('textId');
  const txtModelo = document.getElementById('txtModelo');
  const txtAnoFab = document.getElementById('txtAnoFab');
  const txtVelMax = document.getElementById('txtVelMax');
  const txtAutonomia = document.getElementById("txtAutonomia");
  const txtAltMax = document.getElementById("txtAltMax");
  const txtCantPue = document.getElementById("txtCantPue");
  const txtCantRue = document.getElementById("txtCantRue");
  const dropAbm = document.getElementById('dropAbm');
  const encabezadoAbm = document.getElementById("encabezadoAbm");
  txtId.readOnly = true;
  console.log(txtId.value);

  if(aceptarDatosButton.value === "Agregar Elemento")
  {
      if(dropAbm.selectedIndex === 0)
      {
        const nuevoTerrestre= new Terrestre(0,txtModelo.value,parseInt(txtAnoFab.value),parseInt(txtVelMax.value),
        parseInt(txtCantPue.value),parseInt(txtCantRue.value));
        console.log( nuevoTerrestre);
        if(validaTerrestre( nuevoTerrestre))
        {
          altaVehiculo(nuevoTerrestre);
          console.log("nuevo Terrestre");
        }
        else
        {
          console.log("terrestre no valido");
        }
      }
      else if(dropAbm.selectedIndex === 1)
      {
        const nuevoAereo = new Aereo(0,txtModelo.value,parseInt(txtAnoFab.value),parseInt(txtVelMax.value),
        parseFloat(txtAltMax.value),parseFloat(txtAutonomia.value));
        if(validaAereo(nuevoAereo))
        {
          altaVehiculo(nuevoAereo);
          console.log("nuevo aereo");
        }
      }
      else
      {
        alert("Error al cargar los datos al sistema");
      }
  }
  
}
//aceptarAbmButton.addEventListener('click',handlerAceptar);
aceptarAbmButton.addEventListener('click', (event) => {
    event.preventDefault();
    if(encabezadoAbm.innerHTML == "ALTA")
    {
      handlerAceptar(event);
      muestraFormDatos();
    }
    else
    {
      muestraFormDatos();
    }
    
    
  });
// TABLA 
const crearTabla =(data)=>
{
    if(!Array.isArray(data))return null;
    const table = document.createElement("table");
    const headers = ["id", "modelo", "anoFab", "velMax", "altMax", "autonomia", "cantPue", "cantRue", "modificar", "eliminar"];
    table.appendChild(crearCabecera());
    table.appendChild(crearCuerpo(data,headers));
    return table;
}

const crearCabecera =()=>
{
    const headers = ["id", "modelo", "anoFab", "velMax", "altMax", "autonomia", "cantPue", "cantRue" , "modificar" , "eliminar"];
    const thead = document.createElement("thead");
    const tr = document.createElement("tr");
    headers.forEach(valor=>
    {
        const th = document.createElement("th");
        th.textContent = valor;
        tr.appendChild(th);
    });
    thead.appendChild(tr);
    return thead; 
}

const crearCuerpo =(data,headers)=>
{   
    if(!Array.isArray(headers))return null;
    const tbody = document.createElement("tbody");
  
    data.forEach((vehiculo)=>
    {
        if(obtenerAtributos(data).some(atributo =>vehiculo.hasOwnProperty(atributo)))
        {
            const tr = document.createElement("tr");
            headers.forEach(header => 
            {
                const cell = document.createElement("td");
                cell.classList.add(header.toLowerCase());
                if(header === "modificar")
                {
                   const modificarButton = document.createElement("button");
                   modificarButton.textContent = "Modificar";
                   modificarButton.id = "botonModificar";
                   modificarButton.addEventListener('click',handleModificarClick);
                   //modificarButton.addEventListener('click', () => handleModificarClick(vehiculo))
                   cell.appendChild(modificarButton); 
                }
                else if (header === "eliminar")
                {
                   const eliminarButton = document.createElement("button");
                   eliminarButton.textContent = "Eliminar";
                   eliminarButton.id = "botonEliminar";
                   cell.appendChild(eliminarButton); 
                }
                else if (vehiculo[header]) 
                {
                    cell.textContent = vehiculo[header];
                } 
                else 
                {
                    cell.textContent = "N/A";
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

const actualizarTabla =(contenedor,data)=>
{
    while(contenedor.hasChildNodes())
    {
        contenedor.removeChild(contenedor.firstElementChild);
    }
    contenedor.appendChild(crearTabla(data));   
}

function obtenerAtributos(data) 
{
    const atributos = ["id", "modelo", "anoFab", "velMax", "altMax", "autonomia", "cantPue", "cantRue" , "modificar" , "eliminar"];
    return atributos.filter(atributo => data.some(vehiculo => vehiculo.hasOwnProperty(atributo)));
}

dropdownAbm.addEventListener("change", (event) => 
{
    const selectedValue = event.target.value;
    const txtAltMax = document.getElementById("txtAltMax");
    const txtAutonomia = document.getElementById("txtAutonomia");
    const txtCantPue = document.getElementById("txtCantPue");
    const txtCantRue = document.getElementById("txtCantRue");
    const txtId = document.getElementById("textId");
    txtId.readOnly = true;

    txtAltMax.removeAttribute("disabled");
    txtAltMax.value = "";

    txtAutonomia.removeAttribute("disabled");
    txtAutonomia.value = "";

    txtCantPue.removeAttribute("disabled");
    txtCantPue.value = "";

    txtCantRue.removeAttribute("disabled");
    txtCantRue.value = "";

    txtId.removeAttribute("disabled");
    txtId.value = "";

    if (selectedValue === "terrestre")
    {
      txtAltMax.setAttribute("disabled", "disabled");
      txtAutonomia.setAttribute("disabled", "disabled");
    } 
    else if (selectedValue === "aereo") 
    {
      txtCantPue.setAttribute("disabled", "disabled");
      txtCantRue.setAttribute("disabled", "disabled");
    }
});


aceptarDatosButton.addEventListener('click',(event)=>
{
  event.preventDefault();
  muestraFormAbm();
  document.getElementById("encabezadoAbm").innerHTML = "ALTA :";
  const txtId = document.getElementById('textId');
  const txtAltMax = document.getElementById("txtAltMax");
  const txtAutonomia = document.getElementById("txtAutonomia");
  const txtCantPue = document.getElementById("txtCantPue");
  const txtCantRue = document.getElementById("txtCantRue");
  dropdownAbm.selectedValue = 'terrestre';
  txtId.readOnly = true;

  txtAltMax.removeAttribute('disabled');
  txtAltMax.value = '';
  
  txtAutonomia.removeAttribute('disabled');
  txtAutonomia.value = '';

  txtCantPue.removeAttribute('disabled');
  txtCantPue.value = '';

  txtCantRue.removeAttribute('disabled');
  txtCantRue.value = '';

  txtId.removeAttribute('disabled');
  txtId.value = '';
  if(dropdownAbm.selectedValue === 'terrestre')
  {
    txtAltMax.setAttribute('disabled','disabled');
    txtAutonomia.setAttribute('disabled','disabled');    
  }
  else if(dropdownAbm.selectedValue === 'aereo')
  {
    txtCantPue.setAttribute('disabled','disabled');
    txtCantRue.setAttribute('disabled','disabled');
  } 
});

//Modificacion 
async function postFetch(objeto){
  let respuesta = await fetch(url,{
      method:"POST", 
      headers: {
          'Content-Type': 'application/json'
      },
      mode: 'cors',
      cache: 'no-cache', 
      credentials: 'same-origin',
      body:(JSON.parse(objeto))
  })
  if(respuesta.ok)
  {
    let resultado = await response.json();
    alert(resultado);
    muestraFormAbm();
  }
  else 
  {
    alert("Error en la solicitud:", response.status, response.statusText);
  }
}

async function ejecutarFetch(objeto){
  await postFetch(objeto);
}

async function mod(modVehiculo) 
{
  if (modVehiculo != null) {
    try {
       
      await ejecutarFetch(modVehiculo);
      const lista = JSON.parse(localStorage.getItem("lista")) || [];
      let index = lista.findIndex((vehiculo) => vehiculo.id == modVehiculo.id);
      lista.splice(index, 1, modVehiculo);
      localStorage.setItem("lista",JSON.stringify(lista));
      actualizarTabla(seccionTabla, lista);
    } 
    catch (error) 
    {
      alert("Error en modificacion:", error);
      //muestraFormDatos();
    }
    finally
    {
      //spinner.style.display = "none";
    }
  }
}

function handleModificarClick(vehiculo,event) 
{
  event.preventDefault();
  alert("entre en handlermod");
  const encabezadoAbm = document.getElementById("encabezadoAbm");
  encabezadoAbm.innerHTML = "MODIFICACIÓN:";

  if(encabezadoAbm.innerHTML === "MODIFICACION:")
  {
        if(dropAbm.selectedIndex === 0)
        {
            cargarFormTerrestre(vehiculo);
            const modificadoTerrestre =new Terrestre(0,txtModelo.value,parseInt(txtAnoFab.value),parseInt(txtVelMax.value),
            parseInt(txtCantPue.value),parseInt(txtCantRue.value));
            modificadoTerrestre.setID(parseInt(txtId.value));
            if(validaTerrestre(modificadoTerrestre ))
            {
                mod(modificadoTerrestre);
                alert("modificado terrestre");
            }
        }
        else if(dropAbm.selectedIndex === 1)
        {
            cargarFormAereo(vehiculo);
            const modAereo = new Aereo(0,txtModelo.value,parseInt(txtAnoFab.value),parseInt(txtVelMax.value),
            parseInt(txtAltMax.value),parseInt(txtAutonomia.value));
            modAereo.setID(parseInt(txtId.value));
            if(validaAereo(modAereo))
            {
                mod(modAereo);
                console.log("modificado aereo");
            }
        }
        else
        {
        alert("Error al cargar los datos al sistema");
        }
  }  
}

//Carga de forms
function cargarFormTerrestre(listaTerrestre) 
{
    const txtId = document.getElementById('textId');
    const txtModelo = document.getElementById('txtModelo');
    const txtAnoFab = document.getElementById('txtAnoFab');
    const txtVelMax = document.getElementById('txtVelMax');
    const txtCantPue = document.getElementById("txtCantPue");
    const txtCantRue = document.getElementById("txtCantRue");
    const dropAbm = document.getElementById('dropAbm');
    const txtAltMax = document.getElementById("txtAltMax");
    const txtAutonomia = document.getElementById("txtAutonomia");

    dropAbm.selectedIndex = 0;
    dropAbm.setAttribute('disabled','disabled');
    txtAltMax.setAttribute('disabled','disabled');
    txtAutonomia.setAttribute('disabled','disabled');
    txtId.readOnly = true;

    if (txtId && txtModelo && txtAnoFab && txtVelMax && txtCantPue && txtCantRue) 
    {
        txtId.value = listaTerrestre.id;
        txtModelo.value = listaTerrestre.modelo;
        txtAnoFab.value = listaTerrestre.anoFab;
        txtVelMax.value = listaTerrestre.velMax;
        txtCantPue.value = listaTerrestre.cantPue;
        txtCantRue.value = listaTerrestre.cantRue;
    } 
    else 
    {
        console.error('Algunos campos del formulario de ABM no fueron encontrados.');
    }
}
  
function cargarFormAereo(listaAereo)
{
    const txtId = document.getElementById('textId');
    const txtModelo = document.getElementById('txtModelo');
    const txtAnoFab = document.getElementById('txtAnoFab');
    const txtVelMax = document.getElementById('txtVelMax');
    const txtCantPue = document.getElementById("txtCantPue");
    const txtCantRue = document.getElementById("txtCantRue");
    const dropAbm = document.getElementById('dropAbm');
    const txtAltMax = document.getElementById("txtAltMax");
    const txtAutonomia = document.getElementById("txtAutonomia");

    dropAbm.selectedIndex = 1;
    dropAbm.setAttribute('disabled','disabled');
    txtCantPue.setAttribute('disabled','disabled');
    txtCantRue.setAttribute('disabled','disabled');
    txtId.readOnly = true;

    if (txtId && txtModelo && txtAnoFab && txtVelMax && txtAutonomia && txtAltMax) 
    {
        txtId.value = listaAereo.id;
        txtModelo.value = listaAereo.modelo;
        txtAnoFab.value = listaAereo.anoFab;
        txtVelMax.value = listaAereo.velMax;
        txtAutonomia.value = listaAereo.autonomia;
        txtAltMax.value = listaAereo.altMax;
    } 
    else 
    {
        console.error('Algunos campos del formulario de ABM no fueron encontrados.');
    }
}

function muestraFormAbm()
{
    document.getElementById("formAbm").style.display = "block";
    document.getElementById("formDatos").style.display = "none";
}

function muestraFormDatos()
{
    document.getElementById("formAbm").style.display = "none";
    document.getElementById("formDatos").style.display = "block";
}

const cancelarABMButton = document.getElementById("cancelarAbm");
cancelarABMButton.addEventListener("click", () => {
  // Ocultar el formulario de eliminación/modificación
  muestraFormDatos();
});
