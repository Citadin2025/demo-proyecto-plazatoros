async function obtenerEventos() {
    try {
        console.log("el js de porta eventos esta cargando almenos");
        const respuesta = await fetch("./backend/api/api.php?url=eventos");
        console.log(respuesta);

        const eventos = await respuesta.json(); //okay, ojala alguien agarre y se ponga a arreglar esto, el problema es basicamente esta linea, el json no funciona porque no se reconoce como json, basicamente la poronga esta dice: "emmmmmmm vs tenes <b> y esas puterias de html, no funciono UwU" y en ese mismo momento te agarra de las bolas y las tuerce
        console.log(eventos);

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
        //contenido += `<td>${evento.idEvento}</td>`;
        contenido += `<td>${evento.nombre}</td>`;
        contenido += `<td>${evento.descripcion}</td>`;
        contenido += `<td>${evento.fecha}</td>`;
        contenido += `<td>${evento.linkDeCompra}</td>`;
        //contenido += `<td> <a href="./backend/routes/api.php?url=eventos&action=delete&idEvento=${evento.idEvento}"></a></td>`;
        contenido += `</tr>`;
    });
    return contenido;
}
    
obtenerEventos();
