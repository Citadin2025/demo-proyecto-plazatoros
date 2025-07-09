<?php
require "../config/dataBaseConfig.php"; // Importar la conexión a la base de datos
require "../model/login.php"; // Importar el modelo de Login

$loginModel = new Login($pdo); // Crear una instancia del modelo de Login

// Verificar el método de la solicitud
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si se recibieron los datos necesarios
    if (isset($data["nombre"]) && isset($data["password"])) {
        $nombre = $data["nombre"];
        $password = $data["password"];

        // Llamar al método autenticar del modelo de Login
        $loginModel->autenticar($nombre, $password);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Faltan campos"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>