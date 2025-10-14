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

document.addEventListener("DOMContentLoaded", () => {

  // ==== Lazy-loading con efecto blur ====
  const lazyImages = document.querySelectorAll("img.lazy");

  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;

          // Quitar blur solo cuando la imagen está completamente cargada
          img.onload = () => {
            img.classList.remove("lazy");
          };

          observer.unobserve(img);
        }
      });
    }, { rootMargin: "200px 0px" });

    lazyImages.forEach(img => observer.observe(img));
  } else {
    // fallback para navegadores antiguos
    lazyImages.forEach(img => {
      img.src = img.dataset.src;
      img.onload = () => img.classList.remove("lazy");
    });
  }

  // ==== Lightbox ====
  const images = document.querySelectorAll(".gallery img");
  const lightbox = document.createElement("div");
  lightbox.classList.add("lightbox");

  const img = document.createElement("img");
  const closeBtn = document.createElement("button");
  closeBtn.textContent = "✕";
  closeBtn.classList.add("lightbox-close");

  lightbox.appendChild(img);
  lightbox.appendChild(closeBtn);
  document.body.appendChild(lightbox);

  images.forEach(image => {
    image.addEventListener("click", () => {
      img.src = image.src;
      lightbox.classList.add("active");
    });
  });

  closeBtn.addEventListener("click", () => lightbox.classList.remove("active"));

  lightbox.addEventListener("click", e => {
    if (e.target === lightbox) lightbox.classList.remove("active");
  });

  document.addEventListener("keydown", e => {
    if (e.key === "Escape" && lightbox.classList.contains("active")) {
      lightbox.classList.remove("active");
    }
  });

});
