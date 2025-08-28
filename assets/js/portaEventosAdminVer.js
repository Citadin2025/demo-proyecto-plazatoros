async function obtenerEventos() {
    document.getElementById("nombre").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("fecha").value = "";
    document.getElementById("linkDeCompra").value = "";
    document.getElementById("imagen").value = "";

    try {
        const respuesta = await fetch("./backEnd/api/api.php?url=eventos");
        const eventos = await respuesta.json();
        const contenedorAdmin = document.getElementById("contenedor-eventos");
        contenedorAdmin.innerHTML = mostrarEventosAdminVer(eventos);
    }
    catch (error) {
        console.error("error al obtener eventos" + error);
    }

}

// check if URL ends with a common image file extension
function isImageUrl(url) {
  // Strip query strings and hash fragments
  const cleanUrl = url.split(/[?#]/)[0];

  // Match only if the extension is at the very end
  return /\.(jpe?g|png|gif|bmp|webp|svg)$/i.test(cleanUrl);
}


// validate image URL on form submission
document.getElementById("formulario-evento").addEventListener("submit", function (event) {
    const url = document.getElementById("imagen").value;
    if (!isImageUrl(url)) {
        event.preventDefault();
        alert("Pone una imagen posta gato (jpg, jpeg, png, gif, bmp, webp, svg).");
    }
});

function mostrarEventosAdminVer(evento) {
    let contenido = "";
    evento.forEach(evento => {
        contenido += `<tr>`;
        contenido += `<td><img src="${evento.imagen}" alt="No encontramos una foto de ${evento.nombre}" height="140px" width="120px"></td>`;
        contenido += `<td>${evento.eventoID}</td>`;
        contenido += `<td>${evento.nombre}</td>`;
        contenido += `<td>${evento.descripcion}</td>`;
        contenido += `<td>${evento.fecha}</td>`;
        contenido += `<td>${evento.linkDeCompra}</td>`;
        contenido += `<td> <button onClick="eliminarEvento(${evento.eventoID}); confirm('¿Estás seguro de que deseas eliminar este evento?');" id="btn-eliminar"> Eliminar </button></td>`;
        contenido += `<td> <button onClick="cargarEventoEnFormulario(${evento.eventoID}); window.scrollTo({ top: 0, behavior: 'smooth' });" id="btn-modificar"> Modificar </button></td>`;
        contenido += `</tr>`;
    });
    return contenido;
}

obtenerEventos();

// toma los datos de la bd y los carga en los campos, user modifica a gusto y confirma haciendo click en el boton nuevo que aparece
async function modificarEvento(evento) {
    try {
        const response = await fetch('./backEnd/api/api.php?url=modificarEvento', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(evento) // must include eventoID
        });

        const result = await response.json();
        if (result.status === "success") {
            alert(result.message);
            obtenerEventos(); // refresh events list
        }
        else {
            console.log("Error: " + result.message);
        }
    } catch (err) {
        console.error(err);
        console.log("Error de red al modificar el evento");
        obtenerEventos(); // refresh events list
    }
}

async function obtenerEvento(eventoID) {
    const response = await fetch(`./backEnd/api/api.php?url=eventos&eventoID=${eventoID}`);
    const evento = await response.json();
    return evento;
}

// IMPORTANTE: el boton de confirmar modificacion se crea y elimina dinamicamente, no existe en el HTML
//---------> IMPORTANTE 2: LOS BOTONES DE MODIFICAR Y ELIMINAR SE DESHABILITAN MIENTRAS SE ESTA EDITANDO UN EVENTO!!!!! <--------------------
async function cargarEventoEnFormulario(eventoID) {
    const evento = await obtenerEvento(eventoID);
    console.log(evento);

    document.getElementById("nombre").value = evento.nombre;
    document.getElementById("descripcion").value = evento.descripcion;
    document.getElementById("fecha").value = evento.fecha;
    document.getElementById("linkDeCompra").value = evento.linkDeCompra;
    document.getElementById("imagen").value = evento.imagen;

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    const formulario = document.getElementById("formulario-evento");

    // Check if a confirm button already exists
    let existingButton = document.getElementById("boton-confirmar-modificacion");
    if (existingButton) return; // Stop if already editing

    // Disable all modify/delete buttons while editing
    const allButtons = document.querySelectorAll("#btn-modificar, #btn-eliminar");
    allButtons.forEach(btn => btn.disabled = true);
    document.getElementById("enviar").disabled = true; // Disable add button too

    // Create confirm button
    const botonModificar = document.createElement("button");
    botonModificar.id = "boton-confirmar-modificacion";
    botonModificar.textContent = "Confirmar Modificación";
    botonModificar.onclick = function () {
        const eventoActualizado = {
            eventoID: eventoID,
            nombre: document.getElementById("nombre").value,
            descripcion: document.getElementById("descripcion").value,
            fecha: document.getElementById("fecha").value,
            linkDeCompra: document.getElementById("linkDeCompra").value,
            imagen: document.getElementById("imagen").value,
            administradorID: evento.administradorID
        };
        modificarEvento(eventoActualizado);

        // Remove confirm button and re-enable other buttons
        botonModificar.remove();
        allButtons.forEach(btn => btn.disabled = false);
        document.getElementById("enviar").disabled = false; // enable add button
    };

    formulario.appendChild(botonModificar);
}

function eliminarEvento(eventoID) {
    fetch(`./backEnd/api/api.php?url=eliminarEvento&eventoID=${eventoID}`, {
        method: 'DELETE'
    })
        .then(response => {
            if (response.ok) {
                console.log("Evento eliminado correctamente");
                obtenerEventos(); // Actualiza la lista de eventos
            } else {
                console.error("Error al eliminar el evento");
            }
        })
}