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

        echo " <head>
        <meta http-equiv='refresh' content='0; URL=../../administrarEvento.html'>
        </head> ";
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
        echo " <head>
        <meta http-equiv='refresh' content='0; URL=../../administrarEvento.html'>
        </head> ";

    } else echo json_encode([
        "status" => "failed",
        "message" => "You can't do that."
    ]);
} elseif($requestMethod == "PUT"){
    $solicitud = $_GET["url"];
    if($solicitud == "modificarEvento"){
        $eventId = $_GET["eventId"];
        $newName = $_GET["nombre"];
        $newDate = $_GET["date"];
        $newDescription = $_GET["description"];
        $newImage = $_GET["imageLink"];
        $newBuyLink = $_GET["buyLink"];
        $newAdminId = $_GET["adminId"];
        $newTimeSTamp = $_GET["timeStamp"];

        modificarEvento($eventId, $newName, $newDate, $newDescription, $newImage, $newBuyLink, $newAdminId, $newTimeSTamp);
        // name date description imageLink buyLink adminId timeStamp

        echo " <head>
        <meta http-equiv='refresh' content='0; URL=../../administrarEvento.html'>
        </head> ";

    } else echo json_encode([
        "status" => "failed",
        "message" => "You can't do that."
    ]);
}
?>
