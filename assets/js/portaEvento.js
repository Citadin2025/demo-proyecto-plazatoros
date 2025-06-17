//aca vamos a hacer que los eventos se muestren en la pagina 
async function obtenerEventos() {
    try {
        console.log("el js de porta eventos esta cargando almenos");
        const respuesta = await fetch("./backend/api/api.php?url=eventos");
        console.log(respuesta);

        const eventos = await respuesta.json(); //okay, ojala alguien agarre y se ponga a arreglar esto, el problema es basicamente esta linea, el json no funciona porque no se reconoce como json, basicamente la poronga esta dice: "emmmmmmm vs tenes <b> y esas puterias de html, no funciono UwU" y en ese mismo momento te agarra de las bolas y las tuerce
        console.log(eventos);
        const contenedor = document.getElementById("cartaEvento");
        console.log(eventos);
        contenedor.innerHTML = mostrarEventos(eventos);
    }
    catch (error) {
        console.error("error al obtener eventos" + error);
    }


}

function mostrarEventos(evento) {
    let contenido = "";
    evento.forEach(evento => {
        contenido += `<div class="card">`;
        contenido += `<img src="${evento.imagen}" alt="${evento.nombre}">`;
        contenido += `<div class="card-content">`;
        contenido += `<h3 class="card-title">${evento.nombre}</h3>`;
        contenido += `<p class="card-text">${evento.descripcion}</p>`;
        contenido += `<div class="card-actions">`;
        contenido += `<button class="read-more">Ver más</button>`;
        contenido += `<a href="${evento.linkDeCompra}" class="card-button">Comprar Ticket</a>`;
        contenido += `</div>`;
        contenido += `</div>`;
        contenido += `</div>`;
    });
    return contenido;
}

obtenerEventos();


