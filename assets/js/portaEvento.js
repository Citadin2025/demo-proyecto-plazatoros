// Obtener eventos desde la API y mostrarlos en el carrusel
async function obtenerEventos() {
  try {
    const respuesta = await fetch("./backEnd/api/api.php?url=eventos");
    const eventos = await respuesta.json();

    // Generar slides
    const contenedor = document.getElementById("carousel-inner");
    contenedor.innerHTML = mostrarEventos(eventos);

    // Generar indicadores
    const indicadores = document.getElementById("carousel-indicators");
    indicadores.innerHTML = generarIndicadores(eventos);

  } catch (error) {
    console.error("Error al obtener eventos: " + error);
  }
}

// Función para generar los slides del carrusel
function mostrarEventos(eventos) {
  let contenido = "";
  eventos.forEach((evento, index) => {
    contenido += `
      <div class="item ${index === 0 ? 'active' : ''}">
        <img src="${evento.imagen}" alt="${evento.nombre}" class="img-responsive center-block">
        <div class="carousel-caption">
          <h3>${evento.nombre}</h3>
          <p>${evento.descripcion}</p>
          <a href="${evento.linkDeCompra}" class="btn btn-primary" target="_blank">Comprar Ticket</a>
        </div>
      </div>
    `;
  });
  return contenido;
}

// Función para generar los indicadores del carrusel
function generarIndicadores(eventos) {
  let indicadores = "";
  eventos.forEach((_, index) => {
    indicadores += `<li data-target="#eventosCarousel" data-slide-to="${index}" ${index === 0 ? 'class="active"' : ''}></li>`;
  });
  return indicadores;
}

// Cargar al iniciar
window.onload = function() {
  obtenerEventos();
};
