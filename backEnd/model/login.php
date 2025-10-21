<?php
require "../config/dataBaseConfig.php";

class Login
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function autenticar($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM administrador WHERE nombreAdministrador = :nombreAdministrador");
        $stmt->bindParam(':nombreAdministrador', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $dummy = '$2y$10$usesomesillystringforsalt$';
        if (!$user) password_verify($password, $dummy);

        if (password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            unset($user['password']); // remove sensitive info

            // store safe values in session
            $_SESSION['user_id'] = $user['administradorID'];
            $_SESSION['username'] = $user['nombreAdministrador'];

            session_regenerate_id(true);
            return 1;
        } else {
            return 0;
        }
    }
}
