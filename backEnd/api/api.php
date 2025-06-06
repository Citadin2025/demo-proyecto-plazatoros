<?php
// filepath: c:\Users\marti\Desktop\folders de apps\Xample\htdocs\TRABAJO FINAL 2025 CITADIN\demo-proyecto-plazatoros\backEnd\api\api.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../controllers/eventoController.php"; // Importar el controlador que maneja la lógica de negocio
require "../config/dataBaseConfig.php"; // Importar la conexión a la base de datos

// Obtener el método de la solicitud HTTP (GET, POST, etc.)
$requestMethod = $_SERVER["REQUEST_METHOD"];

// Si la solicitud es de tipo GET, se llama a la función obtenerEventos()
if ($requestMethod == "GET") {
    $solicitud = $_GET["url"];

     if ($solicitud == "eventos") {
            obtenerEventos();
        }

}