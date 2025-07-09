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
        // verificar en la base de datos si el usuario existe y la contraseña es correcta

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['nombre']) || !isset($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan campos']);
            exit;
        }

        $nombre = $data['nombre'];
        $password = $data['password'];

        $stmt = $this->pdo->prepare("SELECT password FROM administrador WHERE nombreAdministrador = ?");
        $stmt->execute([$nombre]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(['success' => true, 'msg' => 'Login correcto']);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Credenciales inválidas']);
        }
    }
}
