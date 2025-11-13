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
            exit;
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

    $nombre = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensaje = $_POST['message'] ?? '';
    $asunto = $_POST['subject'] ?? '';

    // 🔹 Validar campos vacíos
    if (empty($nombre) || empty($email) || empty($mensaje) || empty($asunto)) {
        echo json_encode([
            "status" => "failed",
            "message" => "Todos los campos son obligatorios."
        ]);
        exit;
    }

    // 🔹 Validar reCAPTCHA
    $captcha = $_POST['g-recaptcha-response'] ?? '';
    $secretKey = '6Le5ygssAAAAAFZBwHprALZgGDUM6Oth3Aagdj-0'; // 👉 Reemplazá esto por tu clave secreta de Google

    if (empty($captcha)) {
        echo json_encode([
            "status" => "failed",
            "message" => "Por favor verifica el captcha."
        ]);
        exit;
    }

    // Verificación con Google
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        echo json_encode([
            "status" => "failed",
            "message" => "Captcha inválido. Inténtalo de nuevo."
        ]);
        exit;
    }

    // 🔹 Si todo está bien, procesar el mensaje normalmente
    if (agregarContacto($nombre, $email, $asunto, $mensaje)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Mensaje enviado exitosamente.'
        ]);
        exit;
    } else {
        echo json_encode([
            'status' => 'failed',
            'message' => 'Error al enviar el mensaje.'
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
    } else if ($solicitud == "contactos") {
        // delete a contact message
        $contactoID = $_GET["contactoID"] ?? null;
        if (!$contactoID) {
            echo json_encode([
                "status" => "failed",
                "message" => "Missing contactoID"
            ]);
            exit;
        }
        $deleted = eliminarContacto($contactoID);
        if ($deleted) {
            echo json_encode([
                "status" => "success",
                "message" => "Mensaje eliminado correctamente"
            ]);
        } else {
            echo json_encode([
                "status" => "failed",
                "message" => "No se pudo eliminar el mensaje"
            ]);
        }
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
