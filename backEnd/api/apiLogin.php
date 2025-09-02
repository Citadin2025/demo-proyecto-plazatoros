<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../controllers/loginController.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];
$solicitud = $_GET["url"] ?? "";

if ($requestMethod === "POST" && $solicitud === "login") {
    $json = file_get_contents("php://input");
    $datos = json_decode($json, true);

    $usuario = $datos["nombre"] ?? '';
    $password = $datos["password"] ?? '';

    $resultado = $loginModel->autenticar($usuario, $password);

    if ($resultado) {
        echo json_encode($resultado);
    } else {
        http_response_code(401);
        echo json_encode(["ok" => false, "error" => "Credenciales inválidas"]);
    }
    exit;
}