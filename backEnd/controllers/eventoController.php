<?php
require "../models/evento.php"; // Importar el modelo
require "../config/dataBaseConfig.php";
//ESTO ES CONTROLLER, NO TE MANDES CAGADA
$eventoModel = new Evento($pdo); // Instancia del modelo

//
function obtenerEventos() {
    global $eventoModel;
    $eventos = $eventoModel->obtenerTodos();
    header('Content-Type: application/json');
    echo json_encode($eventos);
}

function agregarEvento($nombre, $fecha, $descripcion, $imagen, $linkDeCompra) {
    global $eventoModel;
    if ($eventoModel->agregar($nombre, $fecha, $descripcion, $imagen, $linkDeCompra)) {
        
        echo json_encode(["message" => "Evento agregado"]);
    } else {
        echo json_encode(["error" => "Error al agregar el evento"]);
    }
}

function eliminarEvento($idEvento) {
    global $eventoModel;
    if ($eventoModel->eliminar($idEvento)) {
        echo json_encode(["message" => "Evento eliminado"]);
    } else {
        echo json_encode(["error" => "Error al eliminar el evento"]);
    }


}