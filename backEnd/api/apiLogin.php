<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../controllers/loginController.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];
$solicitud = $_GET["url"] ?? "";

if ($requestMethod === "POST") {
    if ($_GET['action'] === 'logout') {
        $_SESSION = [];
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/'); // kill cookie

        echo json_encode(["status" => "ok", "message" => "Logged out"]);
        exit;
    }
    if ($_GET['action'] === "login") {
        $json = file_get_contents("php://input");
        $datos = json_decode($json, true);

        $usuario = trim($datos["nombre"] ?? '');
        $password = trim($datos["password"] ?? '');

        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'Username and password are required.']);
            exit;
        }

        $user = autenticarUsuario($username, $password);

        if ($user) {
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            http_response_code(401);
            echo json_encode(["ok" => false, "error" => "Credenciales inválidas"]);
        }
        exit;
    }
    if ($solicitud == 'logout') {
    }
}