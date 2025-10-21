<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../controllers/loginController.php";
require_once "./checkLogin.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];
$solicitud = $_GET["url"] ?? "";

if ($requestMethod === 'GET') {
    if ($_GET['action'] === 'checkLogin') {
        echo json_encode(['ok' => true, 'message' => 'loggedIn']);
        exit;
    }
    exit;
}

if ($requestMethod === "POST") {

    if ($_GET['action'] === 'logout') {
        $_SESSION = [];
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/'); // kill cookie

        echo json_encode(["status" => "ok", "message" => "Logged out"]);
        exit;
    }
    if ($_GET['action'] === 'login') {
        $input = json_decode(file_get_contents('php://input'), true);
        $username = trim($input['nombre'] ?? '');
        $password = trim($input['password'] ?? '');

        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'Username and password are required.']);
            exit;
        }

    //    echo $username;
    //    echo $password;

        if (autenticarUsuario($username, $password)) {
            echo json_encode(['ok' => true, 'user' => [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            ]]);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid username or password.']);
        }
    }
    if ($solicitud == 'logout') {
    }
}
