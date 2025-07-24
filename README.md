
# 🏛️ Plaza de Toros - Colonia del Sacramento

Este es un sitio web desarrollado para la **Plaza de Toros de Colonia del Sacramento (Uruguay)**. La plataforma busca acercar a los visitantes la historia del lugar, mostrar sus atracciones actuales y mantener actualizado un calendario de eventos. Además, el sistema permite a los administradores gestionar estos eventos fácilmente.

---

## 📸 Características principales

- Página informativa sobre la historia de la Plaza de Toros.
- Secciones para:
  - Servicios turísticos (guías, comida, historia, etc.).
  - Eventos próximos o pasados.
- Área de administración (login) para que el equipo de la plaza pueda:
  - Agregar nuevos eventos.
  - Editar o eliminar eventos existentes.
- Cada evento tiene:
  - Nombre del evento.
  - Descripción.
  - Fecha.
  - Enlace a compra de entradas.
  - Imagen representativa.

---

## ⚙️ Requisitos

- [XAMPP](https://www.apachefriends.org/index.html) o similar (Apache + PHP + MySQL)
- Navegador web moderno (Chrome, Firefox, Edge...)

---

## 🧩 Instalación

1. **Clonar o descargar el repositorio:**

```bash
git clone https://github.com/Citadin2025/demo-proyecto-plazatoros
```

2. **Mover el proyecto a tu directorio de XAMPP:**

```bash
# Suponiendo que estás en Windows
C:\xampp\htdocs\plazatoros
```

3. **Iniciar Apache y MySQL desde el panel de XAMPP.**

4. **Importar la base de datos:**

   - Acceder a `http://localhost/phpmyadmin`.
   - Crear una base de datos, de nombre: `citadin`.
   - Usar la opción "Importar" y subir el archivo `.sql` que se incluye con el proyecto.

5. **Listo! Accedé al sitio en:**

```
http://localhost/demo-proyecto-plazatoros
```

---

## 🔐 Acceso administrativo

Se requiere login para acceder a la zona de gestión de eventos. Los usuarios admin pueden agregar, editar y eliminar eventos desde una interfaz sencilla.

---

## 🎯 Objetivo del proyecto

Este sitio busca:

- Preservar y difundir la historia de un lugar emblemático.
- Promover el turismo cultural y eventos locales.
- Facilitar a la administración de la plaza el manejo de su agenda pública.

---

## 💬 Créditos

Desarrollado por estudiantes para fines educativos.  
Proyecto académico con fines demostrativos.
