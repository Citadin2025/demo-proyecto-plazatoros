<?php
// filepath: c:\Users\marti\Desktop\folders de apps\Xample\htdocs\TRABAJO FINAL 2025 CITADIN\demo-proyecto-plazatoros\backEnd\model\evento.php
// Se importa el archivo que contiene la configuración de la base de datos, que establece la conexión
require "../config/dataBaseConfig.php"; // Importar la conexión a la base de datos

// Definición de la clase Evento que interactuará con la tabla 'eventos' en la base de datos
class Evento {
    private $pdo;  // Declaración de una propiedad privada para almacenar la conexión PDO

    // El constructor recibe el objeto $pdo (conexión a la base de datos) y lo asigna a la propiedad $this->pdo
    public function __construct($pdo) {
        $this->pdo = $pdo;  // Asigna la conexión PDO a la propiedad de la clase
    }

    // Método para obtener todos los libros de la base de datos
    public function obtenerTodos() {
        // Prepara la consulta SQL para seleccionar todos los registros de la tabla 'eventos'
        $stmt = $this->pdo->prepare("SELECT * FROM evento");
        
        // Ejecuta la consulta
        $stmt->execute();
        
        // Devuelve todos los resultados como un array asociativo
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $eventos;
    }

    // Método para agregar un nuevo evento a la base de datos
    public function agregar($nombre, $fecha, $descripcion, $imagen, $linkDeCompra) {
        // Prepara la consulta SQL para insertar un nuevo registro en la tabla 'eventos'
        $stmt = $this->pdo->prepare("INSERT INTO evento (nombre, fecha, descripcion, imagen, linkDeCompra, administradorID) VALUES (:nombre, :fecha, :descripcion, :imagen, :linkDeCompra, 1)"); //IMPORTANTE, AHORA MISMO LA ID DEL ADMIN ESTA HARDCODEADA, UNA VEZ QUE SE TERMINE EL LOGIN VAMOS A HACERLA LINDA (UWU)

        // Ejecuta la consulta con los parámetros proporcionados en la llamada al método
        // Los valores del evento se pasan en un array asociativo
        return $stmt->execute(["nombre" => $nombre, "fecha" => $fecha, "descripcion" => $descripcion, "imagen" => $imagen, "linkDeCompra" => $linkDeCompra]);
    }

    public function eliminar($eventoID) {
        $stmt = $this->pdo->prepare("DELETE FROM evento WHERE id = :id");
        return $stmt->execute(["id" => $eventoID]);
    }

}
?>