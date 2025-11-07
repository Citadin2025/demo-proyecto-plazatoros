<?php
error_reporting(E_ALL);
require "../logging/log.php"; // Importar el archivo de logging para manejar errores
require "../controllers/eventoController.php"; // Importar el controlador que maneja la lógica de negocio
require_once '../controllers/contactoController.php';
require_once "./checkLogin.php";
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    $solicitud = $_GET["url"];
    $idEvento = $_GET["eventoID"] ?? null;

    if ($solicitud === 'eventoRandom') {
        echo json_encode([
            'status' => 'success',
            'response' => obtenerUnEventoRandom()
        ]);
        exit;
    }

    if ($solicitud === 'contactos') {
        if (!checkLogin()) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        } else {
            echo json_encode([
                'status' => 'success',
                'response' => obtenerContactos()
            ]);
        }
    }

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

    if ($solicitud === 'contacto') {

        $data = json_decode(file_get_contents('php://input'), true);

        $nombre = $data['nombre'] ?? '';
        $email = $data['email'] ?? '';
        $mensaje = $data['mensaje'] ?? '';
        $asunto = $data['asunto'] ?? '';

        if (empty($nombre) || empty($email) || empty($mensaje) || empty($asunto)) {
            echo json_encode([
                "status" => "failed",
                "message" => "All fields are required."
            ]);
            exit;
        }

        if (agregarContacto($nombre, $email, $asunto, $mensaje)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Contacto agregado exitosamente.'
            ]);
            exit;
        } else {
            echo json_encode([
                'status' => 'failed',
                'message' => 'Error al agregar el contacto.'
            ]);
            exit;
        }
    }

    if (!checkLogin()) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

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
    if (!checkLogin()) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

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
    if (!checkLogin()) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

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
