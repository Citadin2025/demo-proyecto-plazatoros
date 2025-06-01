const container = document.querySelector('.card-container');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Función para obtener ancho de desplazamiento según tarjeta + gap
const getScrollAmount = () => {
  const card = container.querySelector('.card');
  if (!card) return 300;
  const style = window.getComputedStyle(card);
  const width = card.offsetWidth;
  const gap = 20; // debe coincidir con gap CSS
  return width + gap;
};

prevBtn.addEventListener('click', () => {
  container.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
});
nextBtn.addEventListener('click', () => {
  container.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
});

// Funcionalidad "Ver más / Ver menos"
document.querySelectorAll('.card').forEach(card => {
  const text = card.querySelector('.card-text');
  const btn = card.querySelector('.read-more');

  if (text.scrollHeight <= 100) {
    btn.style.display = 'none';
  }

  btn.addEventListener('click', () => {
    text.classList.toggle('expanded');
    btn.textContent = text.classList.contains('expanded') ? 'Ver menos' : 'Ver más';
  });
});
