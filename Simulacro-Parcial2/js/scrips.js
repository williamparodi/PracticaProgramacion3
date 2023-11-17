
import {Persona} from "./Persona.js";
import {Cliente} from "./Cliente.js";
import {Empleado} from "./Empleado.js";
import { actualizarTabla} from "./tabla.js";
import { validaCliente,validoEmpleado } from "./validaciones.js";
import { lista as listas } from "./lista.js";

//localStorage.setItem("lista",JSON.stringify(listas));
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

var xhttp = new XMLHttpRequest(); //Instancio el objeto
xhttp.onreadystatechange = function() 
{
    if (xhttp.readyState == 4) 
    {
      if(xhttp.status == 200)
      {
        spinner.style.display = "none";
        console.log(xhttp.response);
        if(lista.length)//mm
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
        //aca debería recargar la pagina o algo
      }
    }
};
xhttp.open("GET", "http://localhost/Simulacro-Parcial2/PersonasEmpleadosClientes.php", true); //Inicializo la solicitud
xhttp.send();

formAbm.style.display = "none";

//4- Alta fetch
aceptarDatosButton.addEventListener('click',(event)=>
{
  event.preventDefault();
  console.log("Clic en aceptarDatosButton");
  formulario.style.display = 'none';
  const txtId = document.getElementById('textId');
  const txtCompras = document.getElementById('txtCompras');
  const txtTelefono = document.getElementById('txtTelefono');
  const txtVentas = document.getElementById('txtVentas');
  const txtSueldo = document.getElementById('txtSueldo');
  dropdownAbm.selectedValue = 'cliente';
  txtId.readOnly = true;
  txtCompras.removeAttribute('disabled');
  txtCompras.value = '';
  
  txtTelefono.removeAttribute('disabled');
  txtTelefono.value = '';

  txtVentas.removeAttribute('disabled');
  txtVentas.value = '';

  txtSueldo.removeAttribute('disabled');
  txtSueldo.value = '';

  txtId.removeAttribute('disabled');
  txtId.value = '';
  if(dropdownAbm.selectedValue === 'cliente')
  {
    txtSueldo.setAttribute('disabled','disabled');
    txtVentas.setAttribute('disabled','disabled');
    
  }
  else if(dropdownAbm.selectedValue === 'empleado')
  {
    txtCompras.setAttribute('disabled','disabled');
    txtTelefono.setAttribute('disabled','disabled');
  }
  formAbm.style.display = "block";

}); 

async function putFetch(objeto)
{
  const response = await fetch("http://localhost/Simulacro-Parcial2/PersonasEmpleadosClientes.php", 
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
  const response = await fetch("http://localhost/Simulacro-Parcial2/PersonasEmpleadosClientes.php", {
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

let personaSelecionada = {"id":1, "nombre":"Marcelo", "apellido":"Luque", "edad":45, "ventas":15000, "sueldo":2000};
modButton.addEventListener('click',(e)=>{
  ejecutarModPersona(personaSelecionada);
});



function actualizarStorage(clave, data) {
  localStorage.setItem(clave, JSON.stringify(data));
}

dropdownAbm.addEventListener("change",(event)=>
{
    const selectedValue = event.target.value;
    const txtCompras = document.getElementById('txtCompras');
    const txtTelefono = document.getElementById('txtTelefono');
    const txtVentas = document.getElementById('txtVentas');
    const txtSueldo = document.getElementById('txtSueldo');
    const txtId = document.getElementById('textId');
    txtId.readOnly = true;
    
    txtCompras.removeAttribute('disabled');
    txtCompras.value = '';
    
    txtTelefono.removeAttribute('disabled');
    txtTelefono.value = '';
  
    txtVentas.removeAttribute('disabled');
    txtVentas.value = '';
  
    txtSueldo.removeAttribute('disabled');
    txtSueldo.value = '';
  
    txtId.removeAttribute('disabled');
    txtId.value = '';
    
    if(selectedValue === 'cliente')
    {
      txtSueldo.setAttribute('disabled','disabled');
      txtVentas.setAttribute('disabled','disabled');
    }
    else if(selectedValue === 'empleado')
    {
      txtCompras.setAttribute('disabled','disabled');
      txtTelefono.setAttribute('disabled','disabled');
    }
});

aceptarAbmButton.addEventListener('click',handlerAceptar);

//Carga de Forms
function cargarFormEmpleados(listaEmpleados) 
{
    const txtId = document.getElementById('textId');
    const txtNombre = document.getElementById('txtNombre');
    const txtApellido = document.getElementById('txtApellido');
    const txtEdad = document.getElementById('txtEdad');
    const txtVentas = document.getElementById('txtVentas');
    const txtSueldo = document.getElementById('txtSueldo');
    const dropAbm = document.getElementById('dropAbm');
    const txtCompras = document.getElementById('txtCompras');
    const txtTelefono = document.getElementById('txtTelefono');

    dropAbm.selectedIndex = 1;
    dropAbm.setAttribute('disabled','disabled');
    txtCompras.setAttribute('disabled','disabled');
    txtTelefono.setAttribute('disabled','disabled');
    txtId.readOnly = true;

    if (txtId && txtNombre && txtApellido && txtEdad && txtVentas && txtSueldo) 
    {
        txtId.value = listaEmpleados.id;
        txtNombre.value = listaEmpleados.nombre;
        txtApellido.value = listaEmpleados.apellido;
        txtEdad.value = listaEmpleados.edad;
        txtVentas.value = listaEmpleados.ventas;
        txtSueldo.value = listaEmpleados.sueldo;
    } 
    else 
    {
        console.error('Algunos campos del formulario de ABM no fueron encontrados.');
    }
}
  
function cargarFormClientes(listaClientes)
{
  const txtId = document.getElementById('textId');
  const txtNombre = document.getElementById('txtNombre');
  const txtApellido = document.getElementById('txtApellido');
  const txtEdad = document.getElementById('txtEdad');
  const txtCompras = document.getElementById('txtCompras');
  const txtTelefono = document.getElementById('txtTelefono');
  const txtVentas = document.getElementById('txtVentas');
  const txtSueldo = document.getElementById('txtSueldo');
  const dropAbm = document.getElementById('dropAbm');

  dropAbm.selectedIndex = 0;
  dropAbm.setAttribute('disabled','disabled');
  txtSueldo.setAttribute('disabled','disabled');
  txtVentas.setAttribute('disabled','disabled');
  //para que no se pueda editar
  txtId.readOnly = true;

  if (txtId && txtNombre && txtApellido && txtEdad && txtCompras && txtTelefono) 
  {
    txtId.value = listaClientes.id;
    txtNombre.value = listaClientes.nombre;
    txtApellido.value = listaClientes.apellido;
    txtEdad.value = listaClientes.edad;
    txtCompras.value = listaClientes.compras;
    txtTelefono.value = listaClientes.telefono;
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
      cargarFormEmpleados(personaSelecionada);
      console.log("Entre en cargaEmpleados");
      
    }
    else if (personaSelecionada.hasOwnProperty("compras"))
    {
      cargarFormClientes(personaSelecionada);
      console.log("Entre en cargaClientes");
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
  const txtCompras = document.getElementById('txtCompras');
  const txtTelefono = document.getElementById('txtTelefono');
  const txtVentas = document.getElementById('txtVentas');
  const txtSueldo = document.getElementById('txtSueldo');
  const dropAbm = document.getElementById('dropAbm');

  txtId.readOnly = true;
  console.log(txtId.value);

  if(aceptarDatosButton.value === "Agregar Elemento")
  {
      if(dropAbm.selectedIndex === 0)
      {
        const nuevoCliente = new Cliente(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        parseFloat(txtCompras.value),txtTelefono.value);
        console.log(idAlta);
        console.log(nuevoCliente);
        if(validaCliente(nuevoCliente))
        {
          alta(nuevoCliente);
          console.log("nuevo cliente");
        }
      }
      else if(dropAbm.selectedIndex === 1)
      {
        const nuevoEmpleado = new Empleado(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        parseFloat(txtSueldo.value),parseFloat(txtVentas.value));
        if(validoEmpleado(nuevoEmpleado))
        {
          alta(nuevoEmpleado);
          console.log("nuevo empleado");
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


async function modificar(editEmpleado) {
  spinner.style.display = "block";
  if (editEmpleado != null) {
    try {
      await ejecutarModPersona(editEmpleado);
      const lista = JSON.parse(localStorage.getItem("lista")) || [];
      let index = lista.findIndex((persona) => persona.id == editEmpleado.id);
      lista.splice(index, 1, editEmpleado);
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
    const txtCompras = document.getElementById('txtCompras');
    const txtTelefono = document.getElementById('txtTelefono');
    const txtVentas = document.getElementById('txtVentas');
    const txtSueldo = document.getElementById('txtSueldo');
    const dropAbm = document.getElementById('dropAbm')

    if(dropAbm.selectedIndex === 0)
    {
        const modificadoCliente = new Cliente(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        parseFloat(txtCompras.value),txtTelefono.value);
        modificadoCliente.setID(parseInt(txtId.value));
        console.log(modificadoCliente);
        if(validaCliente(modificadoCliente))
        {
          modificar(modificadoCliente);
          console.log("modificado cliente");
        }
    }
    else if(dropAbm.selectedIndex === 1)
    {
        const modificadoEmpleado = new Empleado(0,txtNombre.value,txtApellido.value,parseInt(txtEdad.value),
        parseFloat(txtSueldo.value),parseFloat(txtVentas.value));
        modificadoEmpleado.setID(parseInt(txtId.value));
        console.log(modificadoEmpleado);
        if(validoEmpleado(modificadoEmpleado))
        {
          modificar(modificadoEmpleado);
          console.log("modificado empleado");
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

