
import {Persona} from "./Persona.js";
import {Futbolista} from "./Futbolista.js";
import {Profesional} from "./Profesional.js";
import { actualizarTabla} from "./tabla.js";
import { validaProfesional,validaFutbolista} from "./validaciones.js";

const lista = JSON.parse(localStorage.getItem("lista")) || [];
const seccionTabla = document.getElementById("tabla");
const dropdownAbm = document.getElementById("dropAbm");
const aceptarDatosButton = document.getElementById("agregar");
const aceptarAbmButton = document.getElementById('aceptarAbm');
const modButton = document.getElementById("modificar");

//const theads = document.querySelectorAll("th");

const formulario = document.forms[0];
const formAbm = document.forms[1];
//let listaElegida =[];
let idAlta = null;
const spinner = document.getElementById("spinner");
spinner.style.display = "block";

var xhttp = new XMLHttpRequest(); 
xhttp.onreadystatechange = function() 
{
    if (xhttp.readyState == 4) 
    {
      if(xhttp.status == 200)
      {
        spinner.style.display = "none";
        console.log(xhttp.response);
        if(lista.length)
        {
          actualizarTabla(seccionTabla,lista); 
        }
        else
        {
          const data = JSON.parse(xhttp.responseText);
          localStorage.setItem("lista",JSON.stringify(data));
          actualizarTabla(seccionTabla,data);
        }
      }
      else
      {
        alert("Algo salio mal ...");
        spinner.style.display = "block";
      }
    }
};
xhttp.open("GET", "http://localhost/SegundoParcialLabo3/personasFutbolitasProfesionales.php", true); //Inicializo la solicitud
xhttp.send();

formAbm.style.display = "none";

//4- Alta fetch
aceptarDatosButton.addEventListener('click',(event)=>
{
  event.preventDefault();
  console.log("Clic en aceptarDatosButton");
  formulario.style.display = 'none';
  formAbm.style.display = "block";
  const txtId = document.getElementById('textId');
  const txtEquipo = document.getElementById('txtEquipo');
  const txtPosicion = document.getElementById('txtPosicion');
  const txtCantidadGoles = document.getElementById('txtCantidadGoles');
  const txtTitulo = document.getElementById('txtTitulo');
  const txtFacultad = document.getElementById('txtFacultad');
  const txtAñoGraduacion = document.getElementById('txtAñoGraduacion');
  dropdownAbm.selectedValue = 'Futbolista';
  txtId.readOnly = true;
  txtEquipo.removeAttribute('disabled');
    txtEquipo.value = '';
    
    txtPosicion.removeAttribute('disabled');
    txtPosicion.value = '';
  
    txtCantidadGoles.removeAttribute('disabled');
    txtCantidadGoles.value = '';
  
    txtTitulo.removeAttribute('disabled');
    txtTitulo.value = '';
  
    txtId.removeAttribute('disabled');
    txtId.value = '';

    txtFacultad.removeAttribute('disabled');
    txtFacultad.value = '';

    txtCantidadGoles.removeAttribute('disabled');
    txtCantidadGoles.value = '';

    txtAñoGraduacion.removeAttribute('disabled');
    txtAñoGraduacion.value = '';
    
    if(dropdownAbm.selectedValue === 'Futbolista')
    {
      txtTitulo.setAttribute('disabled','disabled');
      txtFacultad.setAttribute('disabled','disabled');
      txtAñoGraduacion.setAttribute('disabled','disabled');
    }
    else if(dropdownAbm.selectedValue === 'Profesional')
    {
      txtEquipo.setAttribute('disabled','disabled');
      txtPosicion.setAttribute('disabled','disabled');
      txtCantidadGoles.setAttribute('disabled','disabled');
    }

}); 

async function putFetch(objeto)
{
  const response = await fetch("http://localhost/SegundoParcialLabo3/personasFutbolitasProfesionales.php", 
  {
    method: 'PUT', 
    headers: 
    {
      'Content-Type': 'application/json'
    },
    mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    body: JSON.stringify(objeto),
  });
  
  if(response.ok)
  {
    let resultado = await response.json();
    idAlta = resultado.id;
    console.log("Entre en fetch");
    console.log(resultado);
  }
  else 
  {
    alert("Error en la solicitud:", response.status, response.statusText);
  }
}

export async function modificarPersona(personaModificada) 
{
  const response = await fetch("http://localhost/SegundoParcialLabo3/personasFutbolitasProfesionales.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    body: JSON.stringify(personaModificada),
  });
  verificaMod(response); 
}

function verificaMod(respuesta)
{
  let promesa = new Promise((exito, fallo)=>
  {
    if (respuesta.ok && personaModificada.id !== 666) 
    {
      exito(console.log("entre en mod"));
    } 
    else 
    {
      fallo(console.log("Error en la solicitud:", respuesta.status, respuesta.statusText));
    }
  });
}

function ejecutarPutFetch(objeto) {
  return putFetch(objeto);
}

export function ejecutarModPersona(objeto)
{
  return modificarPersona(objeto);
}
/*
let personaSelecionada = {"id":1, "nombre":"Marcelo", "apellido":"Luque", "edad":45, "ventas":15000, "sueldo":2000};
modButton.addEventListener('click',(e)=>{
  ejecutarModPersona(personaSelecionada);
});*/



function actualizarStorage(clave, data) {
  localStorage.setItem(clave, JSON.stringify(data));
}

dropdownAbm.addEventListener("change",(event)=>
{
  const selectedValue = event.target.value;
  const txtId = document.getElementById('textId');
  const txtEquipo = document.getElementById('txtEquipo');
  const txtPosicion = document.getElementById('txtPosicion');
  const txtCantidadGoles = document.getElementById('txtCantidadGoles');
  const txtTitulo = document.getElementById('txtTitulo');
  const txtFacultad = document.getElementById('txtFacultad');
  const txtAñoGraduacion = document.getElementById('txtAñoGraduacion');

  txtId.readOnly = true;

  txtId.removeAttribute('disabled');
  txtId.value = '';

    txtEquipo.removeAttribute('disabled');
    txtEquipo.value = '';
    
    txtPosicion.removeAttribute('disabled');
    txtPosicion.value = '';
  
    txtCantidadGoles.removeAttribute('disabled');
    txtCantidadGoles.value = '';
  
    txtTitulo.removeAttribute('disabled');
    txtTitulo.value = '';
  
    

    txtFacultad.removeAttribute('disabled');
    txtFacultad.value = '';

    txtCantidadGoles.removeAttribute('disabled');
    txtCantidadGoles.value = '';

    txtAñoGraduacion.removeAttribute('disabled');
    txtAñoGraduacion.value = '';
    
    if(selectedValue === 'Futbolista')
    {
      txtTitulo.setAttribute('disabled','disabled');
      txtFacultad.setAttribute('disabled','disabled');
      txtAñoGraduacion.setAttribute('disabled','disabled');
    }
    else if(selectedValue === 'Profesional')
    {
      txtEquipo.setAttribute('disabled','disabled');
      txtPosicion.setAttribute('disabled','disabled');
      txtCantidadGoles.setAttribute('disabled','disabled');
    }
});

aceptarAbmButton.addEventListener('click',handlerAceptar);
//Carga de Forms
function cargarFormProfesionals(listaProfesionals) 
{
  const txtId = document.getElementById('textId');
  const txtNombre = document.getElementById('txtNombre');
  const txtApellido = document.getElementById('txtApellido');
  const txtEdad = document.getElementById('txtEdad');
  const txtEquipo = document.getElementById('txtEquipo');
  const txtPosicion = document.getElementById('txtPosicion');
  const txtCantidadGoles = document.getElementById('txtCantidadGoles');
  const txtTitulo = document.getElementById('txtTitulo');
  const txtFacultad = document.getElementById('txtFacultad');
  const txtAñoGraduacion = document.getElementById('txtAñoGraduacion');
  const dropAbm = document.getElementById('dropAbm');
  dropAbm.selectedIndex = 1;
  dropAbm.setAttribute("disabled", "disabled");
  txtEquipo.setAttribute("disabled", "disabled");
  txtPosicion.setAttribute("disabled", "disabled");
  txtCantidadGoles.setAttribute("disabled", "disabled");
  txtId.readOnly = true;

    if (txtId && txtNombre && txtApellido && txtEdad && txtFacultad && txtTitulo && txtAñoGraduacion) 
    {
        txtId.value = listaProfesionals.id;
        txtNombre.value = listaProfesionals.nombre;
        txtApellido.value = listaProfesionals.apellido;
        txtEdad.value = listaProfesionals.edad;
        txtFacultad.value = listaProfesionals.facultad;
        txtTitulo.value = listaProfesionals.titulo;
        txtAñoGraduacion = listaProfesionals.añoGraduacion;
    } 
    else 
    {
        console.error('Algunos campos del formulario de ABM no fueron encontrados.');
    }
}
  
function cargarFormFutbolistas(listaFutbolistas)
{
  const txtId = document.getElementById('textId');
  const txtNombre = document.getElementById('txtNombre');
  const txtApellido = document.getElementById('txtApellido');
  const txtEdad = document.getElementById('txtEdad');
  const txtEquipo = document.getElementById('txtEquipo');
  const txtPosicion = document.getElementById('txtPosicion');
  const txtCantidadGoles = document.getElementById('txtCantidadGoles');
  const txtTitulo = document.getElementById('txtTitulo');
  const txtFacultad = document.getElementById('txtFacultad');
  const txtAñoGraduacion = document.getElementById('txtAñoGraduacion');
  const dropAbm = document.getElementById('dropAbm');

  dropAbm.selectedIndex = 0;
  dropAbm.setAttribute('disabled','disabled');
  txtTitulo.setAttribute('disabled','disabled');
  txtAñoGraduacion.setAttribute('disabled','disabled');
  txtFacultad.setAttribute('disabled','disabled');
  //para que no se pueda editar
  txtId.readOnly = true;

  if (txtId && txtNombre && txtApellido && txtEdad && txtEquipo && txtPosicion) 
  {
    txtId.value = listaFutbolistas.id;
    txtNombre.value = listaFutbolistas.nombre;
    txtApellido.value = listaFutbolistas.apellido;
    txtEdad.value = listaFutbolistas.edad;
    txtCantidadGoles.value = listaFutbolistas.cantidadGoles;
    txtEquipo.value = listaFutbolistas.equipo;
    txtPosicion.value = listaFutbolistas.posicion;
  } 
  else
  {
    console.error('Algunos campos del formulario de ABM no fueron encontrados.');
  }
  
}

/*
seccionTabla.addEventListener('dblclick', (e) => {
  if (e.target.matches('td')) 
  {
    // Cambia el botón "Aceptar" a "Modificar"
    activaBotones();

    //Aca iría lo del spinner dejar en segundo plano el form principal 
    // Oculta el formulario de datos y muestra el formulario de ABM con los datos cargados
    document.getElementById('formDatos').style.display = 'none';
    document.getElementById('formAbm').style.display = 'block';

    // Obtiene el ID de la persona seleccionada
    const id = e.target.parentElement.children[0].textContent;
    console.log(id);
    // Encuentra la persona seleccionada
    const personaSelecionada = listaElegida.find((persona) => persona.id == id);
    console.log(personaSelecionada);
    if(personaSelecionada.hasOwnProperty("ventas"))
    {
      // Carga los datos en el formulario de ABM
      cargarFormProfesionals(personaSelecionada);
      console.log("Entre en cargaProfesionals");
      
    }
    else if (personaSelecionada.hasOwnProperty("compras"))
    {
      cargarFormFutbolistas(personaSelecionada);
      console.log("Entre en cargaFutbolistas");
    }
  }
});*/


function handlerAceptar(event) 
{
  event.preventDefault();
  const txtId = document.getElementById('textId');
  const txtNombre = document.getElementById('txtNombre');
  const txtApellido = document.getElementById('txtApellido');
  const txtEdad = document.getElementById('txtEdad');
  const txtEquipo = document.getElementById('txtEquipo');
  const txtPosicion = document.getElementById('txtPosicion');
  const txtCantidadGoles = document.getElementById('txtCantidadGoles');
  const txtTitulo = document.getElementById('txtTitulo');
  const txtFacultad = document.getElementById('txtFacultad');
  const txtAñoGraduacion = document.getElementById('txtAñoGraduacion');

  const dropAbm = document.getElementById('dropAbm');

  txtId.readOnly = true;
  console.log(txtId.value);

  if(aceptarDatosButton.value === "Agregar Elemento")
  {
      if(dropAbm.selectedIndex === 0)
      {
        const nuevoFutbolista = new Futbolista(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        txtEquipo.value,txtPosicion.value,parseInt(txtCantidadGoles.value));
        console.log(idAlta);
        console.log(nuevoFutbolista);
        if(validaFutbolista(nuevoFutbolista))
        {
          alta(nuevoFutbolista);
          console.log("nuevo Futbolista");
        }
        else
        {
          console.log("futbolista no valido");
        }
      }
      else if(dropAbm.selectedIndex === 1)
      {
        const nuevoProfesional = new Profesional(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        txtTitulo.value,txtFacultad.value,parseInt(txtAñoGraduacion.value));
        console.log(txtAñoGraduacion.value);
        if(validaProfesional(nuevoProfesional))
        {
          alta(nuevoProfesional);
          console.log("nuevo Profesional");
        }
      }
      else
      {
        alert("Error al cargar los datos al sistema");
      }
  }  
  // Oculta el formulario de ABM y muestra el formulario de datos
  formAbm.style.display = 'none';
  formulario.style.display = 'block';
  formAbm.reset();
}

//Funciones ABM
async function alta(nuevaPersona) 
{
  spinner.style.display = "block";
  if (nuevaPersona != null) {
    try {
      await ejecutarPutFetch(nuevaPersona);
      nuevaPersona.setID(idAlta);
      const lista = JSON.parse(localStorage.getItem("lista")) || [];
      lista.push(nuevaPersona);
      localStorage.setItem("lista",JSON.stringify(lista));
      actualizarTabla(seccionTabla, lista);
      formAbm.reset();
    } 
    catch (error) 
    {
      console.log("Error en alta:", error);
      // Manejar el error según sea necesario
    }
    finally
    {
      spinner.style.display = "none";
    }
  }
}


async function modificar(editProfesional) {
  spinner.style.display = "block";
  if (editProfesional != null) {
    try {
      await ejecutarModPersona(editProfesional);
      const lista = JSON.parse(localStorage.getItem("lista")) || [];
      let index = lista.findIndex((persona) => persona.id == editProfesional.id);
      lista.splice(index, 1, editProfesional);
      actualizarStorage("lista", lista);
      actualizarTabla(seccionTabla, lista);
      formAbm.reset();
    } catch (error) {
      console.log("Error en modificación:", error);
      // Manejar el error según sea necesario
    } finally {
      spinner.style.display = "none";
    }
  }
}

function handlerBorrar(e) 
{
  e.preventDefault();
  const txtId = document.getElementById('textId');
  console.log(txtId.value);
  if(txtId.value)
  {
    let index = lista.findIndex((persona) => persona.id == txtId.value);
    lista.splice(index, 1);
    //actualizarStorage("lista", lista);
    actualizarTabla(seccionTabla, lista);
    alert("Persona Eliminada");
    formAbm.reset();
    formulario.style.display = 'block';
  }
}

//chat
export function obtenerIdPersonaSeleccionada(event) {
  const botonModificar = event.currentTarget;
  const fila = botonModificar.parentElement.parentElement;
  const idPersona = fila.querySelector('.id').textContent;

  return idPersona;
}

export function obtenerPersonaPorId(idPersonaAModificar) {
  console.log(lista);
  const personaSeleccionada = lista.find(persona => persona.id === idPersonaAModificar);
  return personaSeleccionada;
}


export function modificacion(event)
{
    event.preventDefault();
    const txtId = document.getElementById('textId');
    const txtNombre = document.getElementById('txtNombre');
    const txtApellido = document.getElementById('txtApellido');
    const txtEdad = document.getElementById('txtEdad');
    const txtEquipo = document.getElementById('txtEquipo');
    const txtPosicion = document.getElementById('txtPosicion');
    const txtCantidadGoles = document.getElementById('txtCantidadGoles');
    const txtTitulo = document.getElementById('txtTitulo');
    const dropAbm = document.getElementById('dropAbm')

    if(dropAbm.selectedIndex === 0)
    {
        const modificadoFutbolista = new Futbolista(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        txtEquipo.value,txtPosicion.value,parseInt(txtCantidadGoles.value));
        modificadoFutbolista.setID(parseInt(txtId.value));
        console.log(modificadoFutbolista);
        if(validaFutbolista(modificadoFutbolista))
        {
          modificar(modificadoFutbolista);
          console.log("modificado Futbolista");
        }
    }
    else if(dropAbm.selectedIndex === 1)
    {
        const modificadoProfesional = new Profesional(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        txtTitulo.value,txtFacultad.value,parseInt(txtAñoGraduacion.value));
        modificadoProfesional.setID(parseInt(txtId.value));
        console.log(modificadoProfesional);
        if(validoProfesional(modificadoProfesional))
        {
          modificar(modificadoProfesional);
          console.log("modificado Profesional");
        }
    }
    else
    {
      alert("Error al cargar los datos al sistema");
    }

  // Oculta el formulario de ABM y muestra el formulario de datos
  formAbm.style.display = 'none';
  formulario.style.display = 'block';
}

