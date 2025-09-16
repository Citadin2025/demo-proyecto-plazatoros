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

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // Remove password hash before returning user data
            return $user;
        } else {
            return false;
        }
    }
}
