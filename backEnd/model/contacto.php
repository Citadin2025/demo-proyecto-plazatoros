<?php
require "../config/dataBaseConfig.php"; 

class Contacto {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare('SELECT * FROM consultas');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarContacto($nombre, $email, $asunto, $mensaje){
        $stmt = $this->pdo->prepare('INSERT INTO consultas (nombre, email, asunto, mensaje) VALUES (:nombre, :email, :asunto, :mensaje)');
        $result = $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'asunto' => $asunto,
            'mensaje' => $mensaje
        ]);
        if($result) return true;
        return false;
    }
}