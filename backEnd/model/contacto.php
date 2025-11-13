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

    public function eliminarContacto($id){
        // Try common primary key names. If one throws an error, fall back to the other.
        try {
            $stmt = $this->pdo->prepare('DELETE FROM consultas WHERE consultaID = :id');
            $stmt->execute(['id' => $id]);
            if ($stmt->rowCount() > 0) return true;
        } catch (\Exception $e) {
            // ignore and try next
        }

        try {
            $stmt = $this->pdo->prepare('DELETE FROM consultas WHERE id = :id');
            $stmt->execute(['id' => $id]);
            if ($stmt->rowCount() > 0) return true;
        } catch (\Exception $e) {
            // ignore
        }

        // last attempt: delete by contactoID
        try {
            $stmt = $this->pdo->prepare('DELETE FROM consultas WHERE contactoID = :id');
            $stmt->execute(['id' => $id]);
            if ($stmt->rowCount() > 0) return true;
        } catch (\Exception $e) {
            // ignore
        }

        return false;
    }
}