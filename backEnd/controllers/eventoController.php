<?php
require "../model/evento.php"; // Importar el modelo
require "../config/dataBaseConfig.php";

$eventoModel = new Evento($pdo); 

function obtenerEventos() {
    global $eventoModel;
    echo json_encode($eventoModel->obtenerTodos());
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
?>