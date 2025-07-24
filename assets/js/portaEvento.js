//aca vamos a hacer que los eventos se muestren en la pagina 
async function obtenerEventos() {
    try {
        const respuesta = await fetch("./backEnd/api/api.php?url=eventos");
        const eventos = await respuesta.json();
        const contenedor = document.getElementById("carousel-inner");

        contenedor.innerHTML = mostrarEventos(eventos);
    }
    catch (error) {
        console.error("error al obtener eventos" + error);
    }

}

function mostrarEventos(evento) {
    let contenido = "";
    evento.forEach(evento => {
        contenido += `<div class="item">`;
        contenido += `<img src="${evento.imagen}" alt="${evento.nombre}">`;
        contenido += `<div>`;
        contenido += `<h3 class="card-title">${evento.nombre}</h3>`;
        contenido += `<p class="card-text">${evento.descripcion}</p>`;
        contenido += `<div>`;
        contenido += `<a href="${evento.linkDeCompra}" class="card-button">Comprar Ticket</a>`;
        contenido += `</div>`;
        contenido += `</div>`;
        contenido += `</div>`;
    });
    return contenido;
}

//obtenerEventos();


