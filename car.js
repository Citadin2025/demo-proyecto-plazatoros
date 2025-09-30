let currentSlide = 0;
let slides = [];
let totalSlides = 0;

function showSlide(index) {
    slides.forEach(slide => {
        slide.classList.remove('active');
    });

    if (index >= totalSlides) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = totalSlides - 1;
    } else {
        currentSlide = index;
    }

    slides[currentSlide].classList.add('active');
}

function nextSlide() {
    showSlide(currentSlide + 1);
    console.log('next');
}

function prevSlide() {
    showSlide(currentSlide - 1);
    console.log('prev');
}

function setupCarouselContainers() {
    slides = document.querySelectorAll('.carousel-slide');
    totalSlides = slides.length;

    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    if (prevBtn) { prevBtn.addEventListener('click', prevSlide); }
    if (nextBtn) { nextBtn.addEventListener('click', nextSlide); }
}

async function fetchEvents() {
    const eventData = await fetch('./backEnd/api/api.php?url=eventos', {
        method: 'GET'
    });
    const data = await eventData.json();
    return data;
}

(async () => {
    try {
        const data = await fetchEvents();

        if (data) {
            buildCarousel(data);
            setupCarouselContainers();
        } else {
            console.error("THE ARRAY IS EMPTY YOU DUMMY.");
        }
    } catch (error) {
        console.error(error);
    }
})();

function buildCarousel(data) {
    const container = document.getElementById('carousel-container');

    if (!container) {
        console.error("Carousel container not found! you dumbass!.");
        return;
    }

    data.forEach((event, index) => {
        const slide = document.createElement('div');
        slide.className = 'carousel-slide';

        if (index === 0) slide.classList.add('active');

        const img = document.createElement('img');
        img.src = event.imagen;
        img.alt = event.nombre;

        const caption = document.createElement('div');
        caption.className = 'carousel-caption';

        const title = document.createElement('h3');
        title.textContent = event.nombre;

        const date = document.createElement('p');
        date.className = 'event-date';
        date.textContent = event.fecha;

        const description = document.createElement('p');
        description.textContent = event.descripcion;

        caption.appendChild(title);
        caption.appendChild(date);
        caption.appendChild(description);

        slide.appendChild(img);
        slide.appendChild(caption);

        container.appendChild(slide);
    });
}
