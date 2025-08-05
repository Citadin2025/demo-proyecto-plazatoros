<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../controllers/usuarioController.php";
require_once "../config/dataBaseConfig.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];
$solicitud = $_GET["url"] ?? "";

if ($requestMethod === "POST" && $solicitud === "login") {
    $json = file_get_contents("php://input");
    $datos = json_decode($json, true);

    $usuario = $datos["nombre"] ?? '';
    $password = $datos["password"] ?? '';

    $usuarioController = new UsuarioController();
    $resultado = $usuarioController->login($usuario, $password);

    if ($resultado) {
        echo json_encode([
            "ok" => true,
            "usuario" => $resultado["nombre_usuario"],
            "tipo" => $resultado["tipo"]
        ]);
    } else {
        echo json_encode([
            "ok" => false,
            "error" => "Usuario o contraseña incorrectos"
        ]);
    }
    exit;
}

// Podés agregar aquí otras rutas (masEventos, etc.)
