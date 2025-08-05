<?php
require_once "../config/dataBaseConfig.php";

class UsuarioController {
    public function login($usuario, $password) {
        global $pdo;

        $sql = "SELECT * FROM usuario WHERE nombre_usuario = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado && password_verify($password, $resultado['password'])) {
            return $resultado;
        }

        return null;
    }
}
