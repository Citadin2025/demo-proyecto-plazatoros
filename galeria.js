// ==== Lightbox simple y fluido ====

document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll(".gallery img");
  const lightbox = document.createElement("div");
  lightbox.classList.add("lightbox");

  const img = document.createElement("img");
  const closeBtn = document.createElement("button");
  closeBtn.textContent = "✕";

  lightbox.appendChild(img);
  lightbox.appendChild(closeBtn);
  document.body.appendChild(lightbox);

  // Cuando haces clic en una imagen
  images.forEach(image => {
    image.addEventListener("click", () => {
      img.src = image.src;
      lightbox.classList.add("active");
    });
  });

  // Cerrar al hacer clic en el botón
  closeBtn.addEventListener("click", () => {
    lightbox.classList.remove("active");
  });

  // Cerrar al hacer clic fuera de la imagen
  lightbox.addEventListener("click", e => {
    if (e.target === lightbox) {
      lightbox.classList.remove("active");
    }
  });

  // Cerrar con tecla Escape
  document.addEventListener("keydown", e => {
    if (e.key === "Escape" && lightbox.classList.contains("active")) {
      lightbox.classList.remove("active");
    }
  });
});
