<?php
require "../model/evento.php"; // Importar el modelo
require "../config/dataBaseConfig.php";

$eventoModel = new Evento($pdo); 

function obtenerEventos() {
    global $eventoModel;
    echo json_encode($eventoModel->obtenerTodos());
}

function agregarEvento($nombre, $descripcion, $fecha, $imagen, $linkDeCompra) {
    global $eventoModel;
    if ($eventoModel->agregar($nombre, $descripcion, $fecha, $imagen, $linkDeCompra)) {
        
        echo json_encode(["message" => "Evento agregado"]);
    } else {
        echo json_encode(["error" => "Error al agregar el evento"]);
    }
}

// name date description imageLink buyLink adminId timeStamp
function modificarEvento($eventId, $newName, $newDate, $newDescription, $newImageLink, $newBuyLink, $newAdminId, $newTimeStamp){
    global $eventoModel;
    if($eventoModel->modificar($eventId, $newName, $newDate, $newDescription, $newImageLink, $newBuyLink, $newAdminId, $newTimeStamp)){
        echo json_encode([
            "status" => "Succesful.",
            "message" => "Modified succesfuly."
        ]);
    } else {
        echo json_encode([
            "status" => "Failed.",
            "error" => "Failed to modify the event."
        ]);
    }
}

function eliminarEvento($eventoID) {
    global $eventoModel;
    if ($eventoModel->eliminar($eventoID)) {
        echo json_encode(["message" => "Evento eliminado"]);
    } else {
        echo json_encode(["error" => "Error al eliminar el evento"]);
    }


} 
?>