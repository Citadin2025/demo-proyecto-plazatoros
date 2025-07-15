 const form = document.getElementById('loginForm');
    const mensaje = document.getElementById('mensaje');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const nombre = form.usuario.value;
      const password = form.contrasena.value;
        console.log('Intentando iniciar sesión con:', nombre);
        console.log('Contraseña:', password);
      const res = await fetch('./backEnd/api/apiLogin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nombre, password })
      });
        console.log('Respuesta del servidor:', res);
      const data = await res.json();
      if (data.ok) {
        mensaje.textContent = 'Login exitoso';
        mensaje.style.color = 'green';
        // window.location.href = 'panel.html';
      } else {
        mensaje.textContent = data.error || 'Error desconocido';
        mensaje.style.color = 'red';
      }
    });