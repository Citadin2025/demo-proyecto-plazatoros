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
        contenido += `<td> <button method="DELETE" data-url="./backEnd/api/api.php?url=eliminarEvento&eventoID=${evento.eventoID}"> elim </button></td>`;
        contenido += `</tr>`;
    });
    return contenido;
}
    
obtenerEventos();
