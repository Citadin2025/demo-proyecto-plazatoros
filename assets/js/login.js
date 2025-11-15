const form = document.getElementById('loginForm');
const mensaje = document.getElementById('mensaje');

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  const nombre = form.usuario.value;
  const password = form.contrasena.value;

  const res = await fetch('./backEnd/api/apiLogin.php?action=login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre, password })
  });

  const data = await res.json();

  if (data.ok) {
    mensaje.textContent = 'Login exitoso';
    mensaje.style.color = 'green';
    window.location.href = './administrarEvento.html';
  } else {
    mensaje.textContent = data.error || 'Error desconocido';
    mensaje.style.color = 'red';
  }
});