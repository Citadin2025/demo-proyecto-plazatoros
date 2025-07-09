<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../config/dataBaseConfig.php"; // Importar la conexión a la base de datos

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "POST") {
    // Obtener los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Verificar si se recibieron los datos necesarios
    if(isset($data["nombre"]) && isset($data["password"])) {
        $nombre = $data["nombre"];
        $password = $data["password"];
        
        // Aquí deberías agregar la lógica para autenticar al usuario
        // Por ejemplo, verificar en la base de datos si el usuario existe y la contraseña es correcta
        
        // Simulación de autenticación exitosa
        if($nombre == "admin" && $password == "1234") {
            echo json_encode([
                "status" => "success",
                "message" => "Login successful"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid credentials"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Missing parameters"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}
?>