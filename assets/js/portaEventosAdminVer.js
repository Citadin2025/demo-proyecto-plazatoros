async function obtenerEventos() {
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

function mostrarEventosAdminVer(evento) {
    let contenido = "";
    evento.forEach(evento => {
        contenido += `<tr>`;
        contenido += `<td><img src="${evento.imagen}" alt="${evento.nombre}"></td>`;
        contenido += `<td>${evento.eventoID}</td>`;
        contenido += `<td>${evento.nombre}</td>`;
        contenido += `<td>${evento.descripcion}</td>`;
        contenido += `<td>${evento.fecha}</td>`;
        contenido += `<td>${evento.linkDeCompra}</td>`;
        contenido += `<td> <button onClick="eliminarEvento(${evento.eventoID})"> eliminar </button></td>`;
        contenido += `</tr>`;
    });
    return contenido;
}
    
obtenerEventos();

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