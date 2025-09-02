<?php
require "../config/dataBaseConfig.php"; // Importar la conexión a la base de datos

class Login
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->$pdo = $pdo;
    }

    public function autenticar($nombre, $password)
    {
        $stmt = $this->pdo->prepare("SELECT id, password, tipo FROM administrador WHERE nombreAdministrador = ?");
        $stmt->execute([$nombre]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return [
                "ok" => true,
                "usuario" => $nombre,
                "tipo" => $user['tipo']
            ];
        }
        return false;
    }

    public function agregar($nombre, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO administrador (nombreAdministrador, passwordAdministrador) VALUES (?, ?)");
        $stmt->execute([$nombre, $hashedPassword]);
    }
}