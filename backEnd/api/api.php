<?php
// filepath: c:\Users\marti\Desktop\folders de apps\Xample\htdocs\TRABAJO FINAL 2025 CITADIN\demo-proyecto-plazatoros\backEnd\api\api.php
error_reporting(E_ALL);
require "../logging/log.php"; // Importar el archivo de logging para manejar errores
require "../controllers/eventoController.php"; // Importar el controlador que maneja la lógica de negocio
// Obtener el método de la solicitud HTTP (GET, POST, etc.)
$requestMethod = $_SERVER["REQUEST_METHOD"];

// Si la solicitud es de tipo GET, se llama a la función obtenerEventos()
if ($requestMethod == "GET") {
    $solicitud = $_GET["url"];
    $idEvento = $_GET["eventoID"] ?? null;

    if ($solicitud == "eventos" && $idEvento === null) {
        obtenerEventos();
    } else if ($solicitud == "eventos" && $idEvento !== null) {
        obtenerUnEvento($idEvento);
    } else echo json_encode([
        "status" => "failed",
        "message" => "You can't do that."
    ]);
} elseif ($requestMethod == "POST") {
    $solicitud = $_GET["url"];
    if ($solicitud == "masEventos") {

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $fecha = $_POST["fecha"];
        $imagen = $_POST["imagen"];
        $linkDeCompra = $_POST["linkDeCompra"];

        // Llama a la función para agregar un evento
        agregarEvento($nombre, $descripcion, $fecha, $imagen, $linkDeCompra);
        echo json_encode([
            "status" => "success",
            "message" => "Evento agregado correctamente"
        ]);

        header("Location: ../../administrarEvento.html");
        exit;
    }
} elseif ($requestMethod == "DELETE") {
    $solicitud = $_GET["url"];
    if ($solicitud == "eliminarEvento") {
        $eventoID = $_GET["eventoID"];
        echo $eventoID;
        // Llama a la función para eliminar un evento
        eliminarEvento($eventoID);
        echo json_encode([
            "status" => "success",
            "message" => "Evento eliminado correctamente"
        ]);
    } else echo json_encode([
        "status" => "failed",
        "message" => "You can't do that."
    ]);
} elseif ($requestMethod == "PUT") {
    $solicitud = $_GET["url"] ?? null;

    if ($solicitud === "modificarEvento") {
        // Read raw JSON from the request body
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            echo json_encode([
                "status" => "failed",
                "message" => "No input received"
            ]);
            exit;
        }

        $eventId = $input["eventoID"] ?? null;
        $newNombre = $input["nombre"] ?? null;
        $newFecha = $input["fecha"] ?? null;
        $newDescripcion = $input["descripcion"] ?? null;
        $newImagen = $input["imagen"] ?? null;
        $newLinkDeCompra = $input["linkDeCompra"] ?? null;
        $administradorID = $input["administradorID"] ?? null;

        // Optional: check required fields
        if (!$eventId || !$newNombre || !$newFecha) {
            echo json_encode([
                "status" => "failed",
                "message" => "Missing required fields"
            ]);
            exit;
        }

        modificarEvento($eventId, $newNombre, $newFecha, $newDescripcion, $newImagen, $newLinkDeCompra, $administradorID);

        echo json_encode([
            "status" => "success",
            "message" => "Evento modificado correctamente"
        ]);
        exit;
    }
} else {
    echo json_encode([
        "status" => "failed",
        "message" => "You can't do that."
    ]);
}